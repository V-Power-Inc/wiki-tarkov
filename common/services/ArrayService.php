<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 17:58
 */

namespace app\common\services;

/**
 * Сервис для обработки нештатных и сложных ситуаций с многомерными вложенным массивам
 *
 * Class ArrayService
 * @package app\common\services
 */
final class ArrayService
{
    /**
     * Метод вычисляет итоговое количество отряда у босса из многомерного вложенного массива
     *
     * @param array $detachment - вложенный массив с количеством свиты босса
     * @return int
     */
    public static function getAmountEscorts(array $detachment): int
    {
        /** Изначальное количество отряда */
        $cnt = 1;

        /** Вычисляем итоговое число отряда с помощью глубокого многомерного массива */
        foreach ($detachment as $item) {
            foreach ($item as $amount) {
                foreach ($amount as $count) {
                    $cnt += $count['count'];
                }
            }
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
            'forest'
        ];
    }
}