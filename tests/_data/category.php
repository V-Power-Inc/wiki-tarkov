<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 30.08.2022
 * Time: 12:54
 *
 * Фикстуры категорий для тестирования страниц справочника лута, а также для Unit тестирования
 *
 * У категорий ID'ы будут 1,2 и 3 соответственно
 */
return [
    [
        'id' => 1,
        'title' => 'Основная категория',
        'parent_category' => null,
        'url' => 'main-category',
        'content' => '<p>Описание новой основной категории</p>',
        'description' => 'Seo описание новой основной категории',
        'keywords' => 'Основная категория, лут, тесты',
        'enabled' => 1,
        'sortir' => 1
    ],
    [
        'id' => 2,
        'title' => 'Основная категория - second',
        'parent_category' => null,
        'url' => 'main-category-second',
        'content' => '<p>Описание новой основной категории - second</p>',
        'description' => 'Seo описание новой основной категории - second',
        'keywords' => 'Основная категория, лут, тесты - second',
        'enabled' => 1,
        'sortir' => 2
    ],
    [
        'id' => 3,
        'title' => 'Основная категория - third',
        'parent_category' => 2,
        'url' => 'main-category-thirdd',
        'content' => '<p>Описание новой основной категории - third</p>',
        'description' => 'Seo описание новой основной категории - third',
        'keywords' => 'Основная категория, лут, тесты - third',
        'enabled' => 0,
        'sortir' => 3
    ]
];