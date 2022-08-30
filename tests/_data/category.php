<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 30.08.2022
 * Time: 12:54
 *
 * Фикстуры категорий для тестирования страниц справочника лута, а также для Unit тестирования
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
        'sortir' => 2
    ]
];