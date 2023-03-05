<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 7:57
 */

namespace app\common\services;

use app\common\interfaces\ApiInterface;
use app\common\models\tasks\TasksResult;
use app\components\MessagesComponent;
use app\models\ApiLoot;
use app\models\ApiSearchLogs;
use app\models\Bosses;
use app\models\forms\ApiForm;
use yii\db\StaleObjectException;
use yii\helpers\Json;
use yii\web\HttpException;

/**
 * Сервис предназначенный для работы с API tarkov.dev и получения необходимой информации с помощью
 * различного рода запросов к GraphQl
 *
 * Подробнее о том как создавать запросы на GraphQl (https://api.tarkov.dev)
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
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Throwable in case delete failed.
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
                  spawnTrigger
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
            $content = $this->getApiData();

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

            /** Возвращаем true в случае, если в массиве есть боссы */
            return true;
        }

        /** Возвращаем false, если устаревшие боссы не были найдены */
        return false;
    }

    /**
     * Функция проверяет - пуста ли таблица с данными о боссах и возвращает bool результат
     * true - если таблица с боссами пуста и false, если нет
     *
     * @return bool
     */
    private function isEmptyBosses(): bool
    {
        return empty(Bosses::find()->all()) ? true : false;
    }

    /**
     * Метод удаляет всю информацию из таблицы
     *
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Throwable in case delete failed.
     * @return bool
     */
    private function removeOldBosses(): bool
    {
        /** Задаем SQL запрос переменной - ищем устаревшие записи */
        $bosses = Bosses::find()->all();

        /** В цикле проходим всех устаревших боссов и удаляем их */
        foreach ($bosses as $boss) {
            $boss->delete();
        }

        /** Возвращаем true - если удаление боссов прошло успешно */
        return true;
    }

    /**
     * Метод получает данные из удаленного источника по переданному параметру запроса
     *
     * @return array
     */
    private function getApiData(): array
    {
        /** Устанавливаем атрибуты запроса (Включая подавление любых ошибок) */
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

        /** Возвращаем true - если сохранение прошло удачно */
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
            $date = date('Y-m-d H:i:s', strtotime($boss->date_create . ' +3 month'));

            /** Если дата записи +3 месяца - меньше текущего времени - запись должна быть помечена на удаление */
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
     * @return void
     */
    public function setItemQuery(string $itemName): void
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
     * Задаем тело запрос, для получения из API информации о квестах торговцев
     * @return void
     */
    private function setTasksQuery(): void
    {
        /** Задаем тело запроса для получения информации о квестах */
        $this->query = 'query {
          # Передаем сюда языковой код, чтобы все на RU было
          tasks (lang: ru) {
            # Название квеста
            name,
            # Для какой фракции квест (Bear или USEC или любая)
            factionName
            # Минимальный уровень игрока для получения квеста
            minPlayerLevel,
            # Задачи квеста, что нужно сделать
            objectives {
              # Тип квеста (Убийство, сдача предметов и т.д.)
              type,
              # Описание задания
              description,
              # Опциональность условия (false - обязательно, true - нет)
              optional
            }
            # Ключи, которые понадобятся для задачи
            neededKeys {
              # Массив с ключами
                    keys {
                name,
                iconLink
              }
            }
            # Требования к другим квестам перед выполнением текущего
            taskRequirements {
              # Название необходимого квеста
              task {
                name
              }
              # Требование к статусу квеста
              status
            }
            # Количество получаемого опыта - за выполнение квеста
            experience,
            # Название карты, на которой надо выполнить квест
            map {
              name
            }
            # Торговец, что выдал квест (Имя и изображение)
            trader {
              name,
              imageLink
            },
            # Можно ли перепроходить квест несколько раз
            restartable
            # Стартовые требования для квеста (Предметы)
            startRewards {
              # Предметы для выполнения квеста
              items {
                item {
                  name,
                  description,
                  iconLink,
                  inspectImageLink
                },
                # Количество стартовых предметов для квеста
                count
              }
            },
            # Награда за квест
            finishRewards {
              # Предметы выдаваемые в награду за выполнение квеста
              items {
                item {
                  name,
                  description,
                  iconLink,
                  inspectImageLink
                },
                # Количество стартовых предметов для квеста
                count
              }
            }
          }
        }';
    }

    /**
     * todo: Метод будет дорабатываться, пока просто тащит данные
     *
     * Вызывая этот метод - получаем JSON с данными о квестах
     */
    public function getTasks()
    {
        /** Сетапим запрос для API на получение информации о квестах */
        $this->setTasksQuery();

        /** Переменная для вызова API и получения данных о квестах */
        $apiData = $this->getApiData();


        $result = new TasksResult($apiData);

        /** TODO: Тут будет проверка, на уже существующие объекты в БД в будущем */

        /** Получаем данные о квестах из API */
        return $result;
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
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Throwable in case delete failed.
     * @return mixed
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

        /** Эксепшн на случай непредвиденных обстоятельств (Мы не должны сюда попадать, т.к. должны по идее остаться в одном из кейсов выше */
        throw new HttpException(500, 'Server error code');
    }

    /**
     * Метод обращается к API с поисковым запросом и либо создает новые AR объекты ApiLoot
     * либо возвращает false, если массив был пустой
     *
     * @param ApiForm $model - единичный объект ApiForm
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
     * @param ApiForm $model - объект ApiForm
     * @return bool
     */
    private function createNewItems(ApiForm $model): bool
    {
        /** Переменная с запросом для получения данных по луту из API */
        $ApiItems = $this->getNewItems($model);

        /** Если предметы в API нашлись */
        if ($ApiItems !== false) {

            /** В цикле проходим весь массив из API и сохраняем в БД новые данные */
            foreach ($ApiItems['data']['items'] as $data) {

                /** Создаем новый объект AR класса ApiLoot */
                $newItem = new ApiLoot();

                /** Присваиваем необходимые атрибуты - в названии предмета удаляем пробелы по бокам */
                $newItem->name = trim($data['name']);
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
            $date = date('Y-m-d H:i:s', strtotime($item->date_create . ' +3 month'));

            /** Если дата записи +3 месяца - меньше текущего времени - запись должна быть помечена на удаление */
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
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Throwable in case delete failed.
     * @return bool
     */
    private function removeOldItemsByName(ApiForm $model): bool
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

        /** Если удаление старых записей прошло удачно - возвращаем true */
        return true;
    }

    /**
     * Метод записывает в ApiSearchLogs данные о поисковых запросах пользователей через ApiForm
     *
     * @param ApiForm $model - объект модели ApiForm
     * @param int $flag - флаг, для проверки - вернулись ли данные по запросу или нет
     * @return bool
     */
    public function setSearchLog(ApiForm $model, int $flag = 0): bool
    {
        /** Создаем новый Ar объект логирующей запросы модели */
        $log = new ApiSearchLogs();

        /** Записываем в атрибут модели запрос, который осуществил пользователь */
        $log->words = $model->item_name;

        /** Записываем код рекапчи пользователя */
        $log->info = $model->recaptcha;

        /** Устанавливаем значение флага (0 - запрос не помог найти предметы, 1 - запрос помог найти предметы) */
        $log->flag = $flag;

        /** Пробуем сохранить и возвращаем bool результат */
        return $log->save();
    }
}