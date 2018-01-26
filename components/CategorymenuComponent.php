<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 26.01.2018
 * Time: 22:51
 */

namespace app\components;
use Yii;
use app\models\Category;

class CategorymenuComponent
{
    /*** Показываем левое меню с категориями на странице справочника категорий ***/
    public function showLeftmenu() {
        $menu = '           <ul class="nav nav-pills nav-stacked categories categories-menu" id="categories-menu">
                <li class="relative active"><a href="#">Оружие</a></li>
                <li class="relative">
                    <a href="#">Экипировка</a>
                    <div class="dcjq-icon">&nbsp;&nbsp;&nbsp;</div>
                        <!-- Подкатегории меню -->
                        <ul class="children-cats">
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Военное снаряжение</a></li>
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Обвесы</a></li>
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Ранцы</a></li>
                        </ul>
                        <!-- Окончание подкатегорий -->
                </li>

                <li class="relative"><a href="#">Медицина</a></li>
                <li class="relative"><a href="#">Квестовые предметы</a></li>
                <li class="relative"><a href="#">Пища</a></li>
                <li class="relative">
                    <a href="#">Хлам</a>
                    <div class="dcjq-icon">&nbsp;&nbsp;&nbsp;</div>
                        <!-- Подкатегории меню -->
                        <ul class="children-cats">
                            <!-- Ljxthybq \'ktvtyn c rkfccjv active -->
                            <li class="level-2 active"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Подкатегория 1</a></li>
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Подкатегория 2</a></li>
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Подкатегория 3</a></li>
                        </ul>
                        <!-- Окончание подкатегорий -->
                </li>
            </ul>';
        
        return $menu;
    }
    
    
}