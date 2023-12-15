<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 30.08.2022
 * Time: 12:54
 *
 * Фикстуры категорий для тестирования страниц справочника лута, а также для Unit тестирования
 *
 * У категорий ID'ы будут 1 и 2 соответственно
 */
return [
    [
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
        'title' => 'Основная категория - second',
        'parent_category' => null,
        'url' => 'main-category-second',
        'content' => '<p>Описание новой основной категории - second</p>',
        'description' => 'Seo описание новой основной категории - second',
        'keywords' => 'Основная категория, лут, тесты - second',
        'enabled' => 1,
        'sortir' => 2
    ]
];