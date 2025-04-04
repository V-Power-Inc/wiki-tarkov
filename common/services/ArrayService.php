<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 17:58
 */

namespace app\common\services;

use app\common\constants\log\ErrorDesc;
use yii\base\{InvalidConfigException, ErrorException};
use Yii;

/**
 * Сервис для обработки нештатных и сложных ситуаций с многомерными вложенным массивам
 *
 * Class ArrayService
 * @package app\common\services
 */
final class ArrayService implements CommonServiceInterface
{
    /**
     * Метод вычисляет итоговое количество отряда у босса из многомерного вложенного массива
     *
     * @param array $detachment - вложенный массив с количеством свиты босса
     * @return int
     * @throws InvalidConfigException
     */
    public static function getAmountEscorts(array $detachment): int
    {
        /** Изначальное количество отряда */
        $cnt = 0;

        /** Через try пробуем вычислить размер свиты */
        try {
            /** Вычисляем итоговое число отряда с помощью глубокого многомерного массива */
            foreach ($detachment as $item) {
                foreach ($item as $amount) {
                    foreach ($amount as $count) {
                        $cnt += $count['count'];
                    }
                }
            }
        } catch (ErrorException $e) { /** Если со структурой массива что-то не так */

            /** Логируем в таблицу проблему - свита не распарсилась */
            LogService::saveErrorData(Yii::$app->request->getUrl(), ErrorDesc::TYPE_ERROR_ARRAY_BOSSES_PEOPLE, ErrorDesc::DESC_ERROR_ARRAY_BOSSES_PEOPLE);
        }

        /** Возвращаем результат в виде числа */
        return $cnt;
    }

    /**
     * Массив с известными URL адресами карт локаций для боссов
     *
     * @return array
     */
    public static function existingMapNames(): array
    {
        return [
            'tamojnya',
            'zavod',
            'razvyazka',
            'lighthouse',
            'night-zavod',
            'rezerv',
            'bereg',
            'terragroup-laboratory',
            'forest',
            'streets-of-tarkov'
        ];
    }
}