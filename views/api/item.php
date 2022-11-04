<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.11.2022
 * Time: 1:03
 *
 * Вьюха с детальной информацией о предмете из API
 *
 * @var yii\web\View $this
 * @var ApiLoot $item - AR объект ApiLoot с данными о предмете
 */

$this->title = 'Предмет: ' . $item->name .' в Escape from Tarkov';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Информация о характеристиках, покупке и продаже ' . $item->name . ' в Escape from Tarkov'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Escape From Tarkov, лут, ' . $item->name
]);


use app\models\ApiLoot;
?>