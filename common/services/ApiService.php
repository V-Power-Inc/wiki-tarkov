<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 7:57
 */

namespace app\common\services;

use app\common\interfaces\ApiInterface;
use app\models\Bosses;
use yii\helpers\Json;

/**
 * Сервис предназначенный для работы с API tarkov.dev и получения необходимой информации с помощью
 * различного рода запросов к GraphQl
 *
 * Подробнее о том как создавать запросы на GraphQl (https://api.tarkov.dev/___graphql)
 *
 * UPD 04-11-2022 - Сервис расширяется, ведется разработка функционала по загрузке предметов по API
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
        if($this->isOldBosses() | $this->isEmptyBosses()) {

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
     * @param string $query - запрос к GraphQl
     * @return array
     */
    private function getApiData(string $query): array
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

        return true;
    }

    /**
     * Метод посылает запрос на сервер и получает набор данных для работы с БД
     *
     * todo: Метод и последовательности в разработке (Придумать как назвать контроллер - пока мысль ApiController)
     *
     * @param string $itemName - имя предмета
     * @return mixed|void
     */
    public function getItem(string $itemName)
    {
        /** Задаем тело запроса для получения информации о боссах */
        $this->query = '{
          items(name: '. $itemName . ', lang: ru, limit: 10) {
            name
            width
            height
            weight
            description
            category {
              name
            }
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
                }
                count
                quantity
              }
            }
          } 
        }';

        echo '<pre>';
        echo print_r($this->getApiData($this->query));
        exit;
        echo '</pre>';
    }




}