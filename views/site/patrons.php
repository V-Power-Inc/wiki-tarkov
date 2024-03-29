<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 10.06.2022
 * Time: 19:10
 */

/** Вьюха с таблицей патронов Escape from Tarkov
 *
 * @var array $partons - Массив данных из AR Patrons в виде массива
 */

use app\models\Patrons;

$this->title = "Таблица патронов Escape from Tarkov";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Таблица патронов Escape from Tarkov с характеристиками каждого вида патрона в удобном виде',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Таблица патронов Escape from Tarkov',
]);
?>
<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 clans-content">

            <div class="size-16 alert alert-info">
                На этой странице представлена таблица патронов Escape from Tarkov с характеристиками каждого вида патрона в удобном виде. С помощью таблицы вы сможете узнать основные характеристики каждого патрона и узнать его эффективные атрибуты для применения в различного рода боевых ситуациях.
                <br>
                <br>
                Каждый вид патрона имеет следующие доступные характеристики, которые помогут вам при ознакомлении:
                <br>
                <br>
                <ul>
                    <li>Вид патрона</li>
                    <li>Урон</li>
                    <li>Пробитие</li>
                    <li>Урон по броне</li>
                    <li>УБ</li>
                    <li>Скорость м/с</li>
                    <li>Снаряды кол-во</li>
                    <li>Точность %</li>
                    <li>Отдача %</li>
                    <li>Шанс фрагментации %</li>
                    <li>Доп. износ оружия</li>
                    <li>Тяжелое кровотечение %</li>
                    <li>Легкое кровотечение %</li>
                    <li>Шанс рикошета</li>
                    <li>Трассер</li>
                </ul>
                <br>
                Используя эти характеристики и данные о каждом виде патрона, вы сможете лучше подготовиться к рейду и учитывать специфику каждого вида патрона. Что повышает ваши шансы на выживания и успешное прохождение рейда.
                <br>
                <br>
                <b>Информация актуализирована 24-12-2023г.</b>

            </div>

            <!-- patrons info -->
            <div class="fix-tables patrons-table"><table border="1" cellpadding="1" cellspacing="1" class="loot-tables patrons-tbl" style="width:1400px">

                    <thead class="sticky-pos">
                        <tr>
                            <th class="pos-sticky-left">Калибр</th>
                            <th class="pos-sticky-left-2">Вид патрона</th>
                            <th>Урон</th>
                            <th>Пробитие</th>
                            <th>Урон по броне</th>
                            <th>УБ</th>
                            <th>Скорость м/с</th>
                            <th>Снаряды кол-во</th>
                            <th>Точность %</th>
                            <th>Отдача %</th>
                            <th>Шанс фрагментации %</th>
                            <th>Тяжелое кровотечение %</th>
                            <th>Легкое кровотечение %</th>
                            <th>Шанс рикошета</th>
                            <th>Трассер</th>
                        </tr>
                    </thead>

                    <tbody class="relative">

                    <?php foreach ($patrons as $patron): ?>
                        <tr>
                            <td class="apt-pos-sticky-left"><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_CALIBER]?></strong></span></td>
                            <td class="apt-pos-sticky-left-2"><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_TYPE]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_DAMAGE]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_PROBITIE]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_DAMAGE_PER_DEFENCE]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_YB]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_SPEED]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_COUNT]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_TOCHN]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_OTDACHA]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_FRAGMENTATION]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_BLOOD_1]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_BLOOD_2]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_RIKOCHET]?></strong></span></td>
                            <td><span style="font-size:14px"><strong><?=$patron[Patrons::ATTR_TRACCER]?></strong></span></td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

            <!-- Расстояние заглушка -->
            <div class="col-lg-12 height-25"></div>

            <?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles'): ?>
                <div class="col-lg-12 comment-fake-side">
                    <div class="recommended-gm-content">
                        <?= $this->render('/other/google-recommended.php'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Расстояние заглушка -->
            <div class="col-lg-12 height-25"></div>

            <div class="col-lg-12 comment-fake-side">
                <?= $this->render('/other/comments');?>
            </div>

        </div>


        <!-- right menu start -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>

    </div>
</div>
