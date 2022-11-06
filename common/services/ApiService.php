<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 7:57
 */

namespace app\common\services;

use app\common\interfaces\ApiInterface;
use app\models\ApiLoot;
use app\models\ApiSearchLogs;
use app\models\Bosses;
use app\models\forms\ApiForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use app\components\MessagesComponent;

/**
 * Сервис предназначенный для работы с API tarkov.dev и получения необходимой информации с помощью
 * различного рода запросов к GraphQl
 *
 * Подробнее о том как создавать запросы на GraphQl (https://api.tarkov.dev/___graphql)
 *
 * Class ApiService
 * @package app\common\services
 */
final class ApiService implements ApiInterface
{
    /** @var array - Атрибут с заголовками запроса */
    private $headers = ['Content-Type: application/json'];

    /** @var string - Атрибут с телом запроса */
    private $query = '';

    /** @var string - Атрибут с основным адресом для получения API */
    private $api_url = 'https://api.tarkov.dev/graphql';

    /** @var string - Атрибут с видом запроса (GET,POST и т.д.) */
    private $method = 'POST';

    /**
     * Метод по получению информации о боссах Escape From Tarkov
     *
     * @param string|null $map_name - Название карты (Параметр может отсутствовать)
     * @return mixed
     */
    public function getBosses(string $map_name = null)
    {
        /** Проверяем, если записи о боссах устарели - проводим следующие операции */
        if ($this->isOldBosses() | $this->isEmptyBosses()) {

            /** Удаляем устаревшую информацию - если даже 1 босс устарел, обновляем всю таблицу */
            $this->removeOldBosses();

            /** Задаем тело запроса для получения информации о боссах */
            $this->query = '{
               maps(lang: ru) {
                name
                bosses {
                  name
                  spawnChance
                  spawnTimeRandom
                  spawnLocations {
                    name
                  }
                  escorts {
                    amount {
                      count
                    }
                  }
                }
              }
            }';

            /** Присваиваем результат запроса переменной */
            $content = $this->getApiData($this->query);

            /** Сохраняем все новые объекты о боссах */
            $this->saveData($content);
        }

        /** Проходим существующие данные и ставим флаги устаревания по мере необходимости */
        $this->setOldBosses();

        /** Возвращаем результат - если в параметр прилетело название карты, возвращаем набор информации о боссах
         * на этой карте, если параметра не было - возвращаем массив со списком карт и Url адресов до карт
         */
        return !empty($map_name) ? JsondataService::getBossData($map_name) : Bosses::getMapData();
    }

    /**
     * Метод проверяет устаревшие записи о боссах и возвращает bool результат
     *
     * @return bool
     */
   private function isOldBosses(): bool
    {
        /** Задаем SQL запрос переменной - ищем устаревшие записи */
        $bosses = Bosses::findAll([Bosses::ATTR_OLD => Bosses::TRUE]);

        /** Если найдены устаревшие боссы - возвращаем true, если нет false */
        if (!empty($bosses)) {
            return true;
        }

        return false;
    }

    /**
     * Функция проверяет - пуста ли таблица с данными о боссах и возвращает bool результат
     *
     * @return bool
     */
    private function isEmptyBosses(): bool
    {
        return empty(Bosses::find()->all()) ? true : false;
    }

    /**
     * Функция проверяет - пуста ли таблицы с данными о предметах
     *
     * @return bool
     */
    private function isEmptyItems(): bool
    {
        return empty(ApiLoot::find()->all()) ? true : false;
    }

    /**
     * Метод удаляет всю информацию из таблицы
     *
     * @return mixed
     * @throws
     */
    private function removeOldBosses()
    {
        /** Задаем SQL запрос переменной - ищем устаревшие записи */
        $bosses = Bosses::find()->all();

        /** В цикле проходим всех устаревших боссов и удаляем их */
        foreach ($bosses as $boss) {
            $boss->delete();
        }
    }

    /**
     * Метод получает данные из удаленного источника по переданному параметру запроса
     *
     * @return array
     */
    private function getApiData(): array
    {
        /** Устанавливаем атрибуты запроса */
        $data = @file_get_contents($this->api_url, false, stream_context_create([
            'http' => [
                'method' => $this->method,
                'header' => $this->headers,
                'content' => Json::encode(['query' => $this->query]),
            ]
        ]));

        /** Возвращаем раскодированный из Json результат в виде массива*/
        return Json::decode($data, true);
    }

    /**
     * Метод сохраняет данные в таблицу Bosses
     *
     * @param array $data - массив с данными о боссах
     * @return bool
     */
    private function saveData(array $data): bool
    {
        /** Проходим в цикле все полученные карты */
        foreach ($data['data']['maps'] as $map) {

            /** Создаем новый AR объект Bosses */
            $model = new Bosses();

            /** Присваиваем атрибуты */
            $model->map = $map['name'];
            $model->bosses = Json::encode($map['bosses']);

            /** Передаем название карты в генератор Url */
            $model->url = TranslateService::mapUrlCreator($map['name']);

            /** Сохраняем новый объект данных о боссе */
            $model->save();
        }

        return true;
    }

    /**
     * Метод проверяет актуальность данных и если они устарели - помечает их на удаление
     *
     * @return bool
     */
    private function setOldBosses(): bool
    {
        /** Задаем переменную с выборкой боссов, которые еще актуальны */
        $bosses = Bosses::findAll([Bosses::ATTR_OLD => Bosses::FALSE]);

        /** В цикле проходим все соответствующие записи */
        foreach ($bosses as $boss) {

            /** Дата устаревания записи */
            $date = date('Y-m-d H:i:s', strtotime($boss->date_create . ' +1 month'));

            /** Если дата записи +1 месяц - меньше текущего времени - запись должна быть помечена на удаление */
            if ($date < date("Y-m-d H:i:s",time())) {

                /** Устанавливаем флаг старой записи */
                $boss->old = Bosses::TRUE;

                /** Сохраняем изменения */
                $boss->save();
            }
        }

        /** Возвращаем true если все прошло успешно */
        return true;
    }

    /**
     * Метод задает тело запроса, для получения данных о предметах
     *
     * @param string $itemName - имя предмета
     * @return mixed|void
     */
    public function setItemQuery(string $itemName)
    {
        /** Задаем тело запроса для получения информации о боссах */
        $this->query = '{
          items(name: "'. $itemName . '", lang: ru, limit: 20) {
            name
            normalizedName
            width
            height
            weight
            description
            category {
              name
            }
            iconLink
            inspectImageLink
            sellFor {
              vendor {
                name
              }
              price
              currency
              currencyItem {
                name
              }
              priceRUB
            }
            buyFor {
              vendor {
                name
              }
              price
              currency
              currencyItem {
                name
              }
              priceRUB
            }
            bartersFor {
              trader {
                name
              }
              level
              taskUnlock {
                name
              }
              requiredItems {
                item {
                  name
                  iconLink
                }
                count
                quantity
              }
            }
            receivedFromTasks {
                name
                trader {
                  name
                }
            }
          } 
        }';
    }

    /**
     * В этом методе, мы обрабатываем поисковый запрос на получение предмета и решаем как с ним поступать
     *
     * Обработаны следующие кейсы:
     * - Предмета нет в базе и в API
     * - Предмета нет в базе но есть в API
     * - Есть предмет в базе
     *
     * @param ApiForm $model - поисковый запрос на получение предмета
     * @return mixed
     * @throws
     */
    public function proccessSearchItem(ApiForm $model)
    {
        /** Проверка - если в БД у нас нет этой записи, тогда должны спарсить и создать */
        if (!ApiLoot::findItemsByName($model->item_name)) {

            /** Если нам удалось создать новые предметы, возвращаем их в контроллер */
            if ($this->createNewItems($model)) {

                /** Проставляем предметам флаги устаревания - после создания новых предметов */
                $this->setOldItems();

                /** Возвращаем в контроллер набор данных, который искали ранее */
                return ApiLoot::findItemsByName($model->item_name);
            }

            /** Возвращаем False в контроллер, если в API нет данных */
            return false;
        }

        /** Проверка - если мы нашли у нас в базе устаревшие записи */
        if (ApiLoot::findOldItemsByName($model->item_name)) {

            /** В цикле проходим все старые записи и удаляем их */
            $this->removeOldItemsByName($model);

            /** Пробуем создать новые предметы, если получилось - возвращаем в контроллер набор данных **/
            if ($this->createNewItems($model)) {

                /** Проставляем предметам флаги устаревания - после создания новых предметов */
                $this->setOldItems();

                /** Возращаем в контроллер конечные данные с запрашиваемым набором */
                return ApiLoot::findItemsByName($model->item_name);
            }

            /** Возвращаем false, если предметы не были сохранены по какой то причине */
            return false;
        }

        /** Проверка, если API нашел у нас в базе нужные предметы */
        if (ApiLoot::findItemsByName($model->item_name)) {

            /** Проставляем предметам флаги устаревания - после создания новых предметов */
            $this->setOldItems();

            /** Удаляем старые предметы - если получили запись из базы */
            return ApiLoot::findItemsByName($model->item_name);
        }

    }

    /**
     * Метод обращается к API с поисковым запросом и либо создает новые AR объекты ApiLoot
     * либо возвращает false, если массив был пустой
     *
     * @param ApiForm $model
     * @return mixed
     */
    private function getNewItems(ApiForm $model)
    {
        /** Задаем тело запроса в API - указывая сделать поиск по параметру полученному из формы */
        $this->setItemQuery($model->item_name);

        /** Задаем переменную с данными полученными по API о предметах */
        $item = $this->getApiData();

        /** Пуляем запрос и проверяем - если ничего, надо делать SetFlash */
        if (empty($item['data']['items'])) {

            /** Возвращаем уведомление, что не смогли найти искомый предмет */
            $messages = new MessagesComponent();
            $message = "<p class='alert alert-danger size-16 margin-top-20'><b>К сожалению мы не смогли ничего найти по вашему запросу, попробуйте другой запрос.</b></p>";
            $messages->setMessages($message);

            /** Возвращаем false - если не смогли найти результат даже по APIшке */
            return false;
        }

        /** Возвращаем результат запроса если все хорошо */
        return $item;
    }

    /**
     * Метод создает новые записи о предметах в базе, если массив полученный от API не пустой
     * возвращает true в случае успеха сохранения или false, если массив API был пуст
     *
     * Важно!!! Есть некоторые предметы, которые могут пересоздаваться, т.к. LIKE не может их корректно вернуть, в
     * перспективе это надо будет исправить
     *
     * @param ApiForm $model - объект ApiForm
     * @return bool
     */
    private function createNewItems(ApiForm $model)
    {
        /** Переменная с запросом для получения данных по луту из API */
        $ApiItems = $this->getNewItems($model);

        /** Если предметы в API нашлись */
        if ($ApiItems !== false) {

            /** В цикле проходим весь массив из API и сохраняем в БД новые данные */
            foreach ($ApiItems['data']['items'] as $data) {

                /** Создаем новый объект AR класса ApiLoot */
                $newItem = new ApiLoot();

                /** Присваиваем необходимые атрибуты */
                $newItem->name = $data['name'];
                $newItem->url = $data['normalizedName'];
                $newItem->json = Json::encode($data);

                /** Сохраняем новые объекты */
                $newItem->save();
            }

            /** Возвращаем true если предметы сохранились */
            return true;
        }

        /** Возвращаем false - если предметы не сохранились */
        return false;
    }

    /**
     * Метод проставляющий устаревание для предметов, полученных по API
     *
     * @return bool
     */
    private function setOldItems(): bool
    {
        /** Выбираем в базе все записи, которые не помечены флагом устаревания */
        $items = ApiLoot::findAll([ApiLoot::ATTR_OLD => ApiLoot::FALSE]);

        /** В цикле проходим все соответствующие записи */
        foreach ($items as $item) {

            /** Дата устаревания записи */
            $date = date('Y-m-d H:i:s', strtotime($item->date_create . ' +1 month'));

            /** Если дата записи +1 месяц - меньше текущего времени - запись должна быть помечена на удаление */
            if ($date < date("Y-m-d H:i:s",time())) {

                /** Устанавливаем флаг старой записи */
                $item->old = ApiLoot::TRUE;

                /** Сохраняем изменения */
                $item->save();
            }
        }

        /** Возвращаем true если все прошло успешно */
        return true;
    }

    /**
     * Метод осуществляющий удаление устаревших предметов API по имени предметов через like
     *
     * @param ApiForm $model - объект формы ApiForm
     * @throws
     */
    private function removeOldItemsByName(ApiForm $model)
    {
        /** Задаем SQL запрос переменной - ищем устаревшие записи */
        $items = ApiLoot::find()
            ->where([ApiLoot::ATTR_OLD => ApiLoot::TRUE])
            ->where(['like', ApiLoot::ATTR_NAME, $model->item_name])
            ->all();

        /** В цикле проходим всех устаревших боссов и удаляем их */
        foreach ($items as $item) {
            $item->delete();
        }
    }

    /**
     * Метод записывает в ApiSearchLogs данные о поисковых запросах пользователей через ApiForm
     *
     * @param ApiForm $model - объект модели ApiForm
     * @return bool
     */
    public function setSearchLog(ApiForm $model): bool
    {
        /** Создаем новый Ar объект логирующей запросы модели */
        $log = new ApiSearchLogs();

        /** Записываем в атрибут модели запрос, который осуществил пользователь */
        $log->words = $model->item_name;

        /** Записываем код рекапчи пользователя */
        $log->info = $model->recaptcha;

        /** Пробуем сохранить */
        return $log->save();
    }

    /**
     * Метод возвращает набор подходящих под описание предметов
     *
     * @param string $name - Поисковый запрос
     * @return string
     */
    public function getItemNameVariables(string $name): string
    {
        /** Задаем тело запроса */
        $this->query = '{
          items(name: "'. $name .'", lang: ru, limit: 10) {
                name
            }
        }';

        /** Переменная с данными их Api **/
        $apiData = $this->getApiData();

        /** Пустой  массив */
        $out = [];

        /** Если массив с данными не пустой - пробуем заполнить пустой массив нужными данными */
        if(!empty($apiData['data']['items'])) {



            foreach ($apiData['data']['items'] as $data) {
                $out[] = ['value' => $data['name']];
            }
        }

        /** Возвращаем конечные данные */
        return Json::encode($out);
    }
}