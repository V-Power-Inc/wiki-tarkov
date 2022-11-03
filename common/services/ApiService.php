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
 * Class ApiService
 * @package app\common\services
 */
final class ApiService implements ApiInterface
{
    /** @var array - Атрибут с заголовками запроса */
    private $headers = ['Content-Type: application/json'];

    /** @var string - Атрибут с телом запроса */
    private $query;

    /** @var string - Атрибут с основным адресов для получения API */
    private $api_url = 'https://api.tarkov.dev/graphql';

    /** @var string - Атрибут с видом запроса (GET,POST и т.д.) */
    private $method = 'POST';

    /**
     * Метод по получению информации о боссах Escape From Tarkov
     *
     * @param string $map_name - Название карты
     * @return Bosses
     */
    public function getBosses(string $map_name): Bosses
    {
        /** Проверяем, если записи о боссах устарели - проводим следующие операции */
        if($this->isOldBosses()) {

            /** Удаляем устаревших боссов */
            $this->removeOldBosses();

            /** Задаем тело запроса для получения информации о боссах */
            $this->query = '{
               maps(lang: ru) {
                name
                bosses {
                  name
                  spawnChance
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

        return $this->getDbData($map_name);
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
     * Метод удаляет устаревших боссов
     *
     * @return mixed
     */
    private function removeOldBosses()
    {
        /** Задаем SQL запрос переменной - ищем устаревшие записи */
        $bosses = Bosses::findAll([Bosses::ATTR_OLD => Bosses::TRUE]);

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

            /** Сохраняем новый объект данных о боссе */
            $model->save();
        }

        return true;
    }

    /**
     * Метод возвращаем AR объект из таблицы Bosses по имени карты
     *
     * @param string $map_name - Название карты
     * @return Bosses
     */
    private function getDbData(string $map_name): Bosses
    {
        return Bosses::findOne([Bosses::ATTR_MAP => $map_name]);
    }
}