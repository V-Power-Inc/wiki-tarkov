<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.12.2018
 * Time: 20:51
 */

/*** Вьюха с призывом включить JS - а также уведомлением что без JS сайт не может нормально функционировать ***/

$this->title='Системный сбой - необходимо включить JavaScript';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Системный сбой - необходимо включить JavaScript.',
]);

?>



<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading text-center">Необходимо включить JavaScript</h1>
    </div>
</div>

<hr class="grey-line">


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <p class="alert alert-danger size-18">В вашей версии браузера отключен JavaScript. Без JavaScript наш сайт не может корректно выдавать информацию и будут недоступны такие разделы, как интерактивные карты, увеличение картинок, а также динамический поиск и раскрывание категорий в справочнике лута. Помимо всего прочего вы полностью теряете возможность пользоваться справочником квестов для каждого из торговцев, а также смотреть их актуальные бартеры на каждом из уровней репутации.
                <br>
                <br>
                Кроме того, без JavaScript вы не сможете задать вопрос нашему консультанту, а также не будут работать разделы вопрос-ответ, для того чтобы избежать этих неприятностей при использовании сайта, необходимо разрешить использование JavaScript на нашем сайте в настройках вашего интернет-браузера.
                <br>
                <br>
                Вам необходимо включить JavaScript - после чего <b>обновить страницу сайта</b>, если все сделано правильно то вы попадете на главную страницу сайта.
            </p>
        </div>
    </div>
</div>


