<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 10.03.2024
 * Time: 23:54
 *
 * Фикстуры для логирующей таблицы
 */

return [
    [
        'id' => 1,
        'type' => 'Ошибка получения данных из API',
        'url' => '/bosses',
        'description' => 'Данные из API не были получены - этап загрузки данных',
        'error_code' => 500,
    ],
    [
        'id' => 2,
        'type' => 'Страница не найдена',
        'url' => '/items',
        'description' => 'Страница не найдена, возможно в БД соответствующая запись была удалена',
        'error_code' => 404,
    ],
];