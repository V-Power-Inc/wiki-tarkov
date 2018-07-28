<?php
$this->title = 'Админка tarkov-wiki';
?>
<div class="col-lg-12 text-center">
    <h1 class="admin-title-main">Главная админская страница</h1>
</div>


<?php if(isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id !== 4 && Yii::$app->user->identity->id !== 5): ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <ul class="nav nav-pills nav-stacked">
        <h2 class="text-center margin-bottom-30">Работа со справочником лута</h2>
        <div class="text-center">
            <li class="d-inline category-admin-margins"><a href="/admin/category/index?dp-1-sort=sortir" class="admin-inline">Категории справочника лута</a></li>
            <li class="d-inline category-admin-margins"><a href="/admin/items" class="admin-inline">Лут в справочнике лута</a></li>
        </div>
    </ul>
</div>

<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-top-30">
    <ul class="nav nav-pills nav-stacked">
        <h2 class="text-center">Квесты торговцев</h2>
        <li><a href="/admin/prapor/" class="admin-tabs w-100-important">Квесты Прапора</a></li>
        <li><a href="/admin/terapevt/" class="admin-tabs w-100-important">Квесты Терапевта</a></li>
        <li><a href="/admin/lyjnic/" class="admin-tabs w-100-important">Квесты Лыжника</a></li>
        <li><a href="/admin/mirotvorec/" class="admin-tabs w-100-important">Квесты Миротворца</a></li>
        <li><a href="/admin/mehanic/" class="admin-tabs w-100-important">Квесты Механика</a></li>
        <li><a href="/admin/baraholshik/" class="admin-tabs w-100-important">Квесты Барахольщика</a></li>
        <li><a href="/admin/skypshik/" class="admin-tabs w-100-important">Квесты Скупщика</a></li>
        <li><a href="/admin/leshy/" class="admin-tabs w-100-important">Квесты Лешего</a></li>
        <!-- disabled for now -->
        <li><a href="#" class="admin-tabs w-100-important unactive">Квесты Электроника</a></li>
        <li><a href="#" class="admin-tabs w-100-important unactive">Квесты Башкира</a></li>
        <li><a href="#" class="admin-tabs w-100-important unactive">Квесты Хохла</a></li>
    </ul>
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-0 col-xs-offset-0 margin-top-30">
    <ul class="nav nav-pills nav-stacked">
        <h2 class="text-center">Маркеры на картах</h2>
        <li><a href="/admin/zavod" class="admin-tabs w-100-important">Маркеры на локации Завод</a></li>
        <li><a href="/admin/forest" class="admin-tabs w-100-important">Маркеры на локации Лес</a></li>
        <li><a href="/admin/tamojnya" class="admin-tabs w-100-important">Маркеры на локации Таможня</a></li>
        <li><a href="/admin/bereg" class="admin-tabs w-100-important">Маркеры на локации Берег</a></li>
        <li><a href="/admin/razvyazka" class="admin-tabs w-100-important">Маркеры на локации Развязка</a></li>
        <!-- disabled -->
        <li><a href="#" class="admin-tabs w-100-important unactive">Маркеры на локации Улицы Таркова</a></li>
        <li><a href="#" class="admin-tabs w-100-important unactive">Маркеры на локации лаб. TerraGroup</a></li>
        <li><a href="#" class="admin-tabs w-100-important unactive">Маркеры на локации Пригород</a></li>
        <li><a href="#" class="admin-tabs w-100-important unactive">Маркеры на локации Поселок</a></li>
        <li><a href="#" class="admin-tabs w-100-important unactive">Маркеры на локации Маяк</a></li>
        <li><a href="#" class="admin-tabs w-100-important unactive">Маркеры на локации Терминал</a></li>
    </ul>
</div>


<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-0 col-xs-offset-0 margin-top-30">
    <ul class="nav nav-pills nav-stacked">
        <h2 class="text-center">Дополнительно</h2>
        <li><a href="/admin/questions" class="admin-tabs w-100-important">Часто задаваемые вопросы</a></li>
        <li><a href="/admin/info" class="admin-tabs w-100-important">Информационные виджеты</a></li>
        <li><a href="/admin/catskills" class="admin-tabs w-100-important">Категории умений</a></li>
        <li><a href="/admin/skills" class="admin-tabs w-100-important">Пассивные умения</a></li>
        <li><a href="/admin/traders/index?dp-1-sort=sortir" class="admin-tabs w-100-important">Торговцы</a></li>
        <li><a href="/admin/doorkeys" class="admin-tabs w-100-important">Справочник ключей</a></li>
        <li><a href="/admin/news" class="admin-tabs w-100-important">Новости</a></li>
        <li><a href="/admin/articles" class="admin-tabs w-100-important">Полезные статьи</a></li>
        <li><a href="/admin/currencies" class="admin-tabs w-100-important">Курсы валют</a></li>
        <!-- disabled -->
        <!-- link to /admin/mapstaticcontent -->
        <li><a href="#" class="admin-tabs w-100-important unactive">Контент в описаниях маркеров</a></li>
    </ul>
</div>

<?php elseif(isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id == 4) : ?>
    <?=$this->render('working-lotttables'); ?>
<?php else: ?>
    <?=$this->render('workingview-nomaps'); ?>
<?php endif; ?>


