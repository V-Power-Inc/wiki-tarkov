<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 13.05.2018
 * Time: 17:30
 */

$this->title = 'Курс валют в Escape from Tarkov';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'В Escape from Tarkov как и в реальном мире - есть свои денежные валюты, у которых также есть активный курс.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Курс валют в Escape from Tarkov',
]);

$this->registerJsFile('js/currencies.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 currencies-content">

            <!-- Статичное описание раздела -->
            <p class="size-16 alert alert-info">В Escape from Tarkov как и в реальном мире - есть свои денежные валюты, у которых также есть активный курс. Валюты в игре подразделяются на несколько типов, также каждая валюта необходима для покупки какого либо снаряжения, например у <a href="<?= $_ENV['DOMAIN_PROTOCOL'].$_ENV['DOMAIN'].'/traders/mirotvorec' ?>" target="_blank">Миротворца</a> большинство товаров покупаются за <b>доллары</b>, а у <a href="<?= $_ENV['DOMAIN_PROTOCOL'].$_ENV['DOMAIN'].'/traders/mehanic'?>" target="_blank">Механика</a> - что то покупается за <b>евро</b> а что то за <b>биткоины</b>. Именно поэтому понимание валютного курса в Escape from Tarkov очень важно.
                <br>
                <br>
                На данный момент в игре доступны следующие виды денежных валют:</p>

            <ul class="currens-images">
                <li><img src="/img/ruble.jpg" class="w-100" alt="Рубль"> - Рубли</li>
                <li><b>$</b> - Доллары</li>
                <li><img src="/img/euro.jpg" class="w-100" alt="Евро"> - Евро</li>
                <li><img src="/img/bitkoin.jpg" class="w-100" alt="Биткоин"> - Биткоины (Эквивалент - монета биткоина)</li>
            </ul>

            <p class="size-16 alert alert-info">В зависимости от дальнейших планов развития игры, курсы валют а также сами валюты в Таркове могут поменяться, на этой странице вы всегда сможете ознакомиться с актуальным курсом валют в Escape from Tarkov.
                <br>
                <br>Ниже приведены курсы валют в Escape from Tarkov актуальные на
                <b><span style="color: #c3392c"><?= date("d-m-Y H:i:s");?></span>.</b>
            </p>

            <!-- Начало рассчетной части -->
            
            <?php if($dollar->enabled==1): ?>
                <!-- Строка курса доллара -->
                <h2 class="curencies-title">Курс Доллара</h2>
                <p class="size-16 alert alert-info">Как было сказано выше - доллар это ходовая валюта у торговца Миротворец - ниже вы сможете узнать актуальный курс доллара, а также воспользоваться калькулятором для рассчета цен.</p>

                <div class="article-stats-padding">
                    <?= $this->render('/other/adsense-article-feed'); ?>
                </div>


                <!-- Блок рассчета под долларовые поля -->
                <div style="padding: 10px;">

                    <!-- Инпут с курсом доллара -->
                    <div class="form-group">
                        <label class="control-label">Курс доллара в рублях:</label>
                        <input class="form-control valute-course" value="1 доллар = <?= $dollar->value/100 ?> рублей." disabled="">

                        <div class="help-block"></div>
                    </div>

                    <!-- Инпут с пересчетом долларов на рубли -->
                    <div class="form-group">
                        <label class="control-label">Введите интересующее количество долларов:</label>
                        <input class="form-control valute-course" id="dollar-refference" oninput="dollarConventer(this.value)" onchange="dollarConventer(this.value)" value="">

                        <div class="help-block"></div>
                    </div>

                    <!-- Поле перессчета долларов на рубли -->
                    <div class="form-group">
                        <label class="control-label">В рублях это составит:</label>
                        <input class="form-control valute-course" id="outputdollar" value="0 руб." disabled="">

                        <div class="help-block"></div>
                    </div>

                </div>
            <?php endif; ?>

            <?php if($euro->enabled==1): ?>
                <!-- Строка курса евро -->
                <h2 class="curencies-title">Курс Евро</h2>
                <p class="size-16 alert alert-info">Евро валюта является ходовой у торговца Механика, за нее он продает различные дополнения для вашего оружия в виде модулей, однако не только он продает товары за евро, у Лыжника также можно найти несколько товаров продаваемых за евро.</p>

                <div class="article-stats-padding">
                    <?= $this->render('/other/adsense-article-feed'); ?>
                </div>

                <!-- Блок рассчета под евро поля -->
                <div style="padding: 10px;">

                    <!-- Инпут с курсом евро -->
                    <div class="form-group">
                        <label class="control-label">Курс евро в рублях:</label>
                        <input class="form-control valute-course" value="1 евро = <?= $euro->value/100 ?> рублей." disabled="">

                        <div class="help-block"></div>
                    </div>

                    <!-- Инпут с пересчетом евро на рубли -->
                    <div class="form-group">
                        <label class="control-label">Введите интересующее количество евро:</label>
                        <input class="form-control valute-course" id="euro-refference" oninput="euroConventer(this.value)" onchange="euroConventer(this.value)" value="">

                        <div class="help-block"></div>
                    </div>

                    <!-- Поле перессчета евро на рубли -->
                    <div class="form-group">
                        <label class="control-label">В рублях это составит:</label>
                        <input class="form-control valute-course" id="outputeuro" value="0 руб." disabled="">

                        <div class="help-block"></div>
                    </div>

                </div>
            <?php endif; ?>


            <?php if($bitkoin->enabled==1): ?>
                <!-- Строка курса биткоина -->
                <h2 class="curencies-title">Курс Биткоина</h2>
                <p class="size-16 alert alert-info">Это самая дорогостоющая валюта, стоимость 1 биткоина в Таркове составляет десятки тысяч рублей. Валюта в ходу у Механика, за нее у него можно купить оружие с отличными боевыми характеристиками. Зачастую ЧВК используют биткоины также для того, чтобы поправить свое финансовое положение - следовательно продавать биткоин тоже очень выгодно.</p>

                <div class="article-stats-padding">
                    <?= $this->render('/other/adsense-article-feed'); ?>
                </div>

                <!-- Блок рассчета под евро поля -->
                <div style="padding: 10px;">

                    <!-- Инпут с курсом биткоина -->
                    <div class="form-group">
                        <label class="control-label">Курс биткоина в рублях:</label>
                        <input class="form-control valute-course" value="1 биткоин = <?= $bitkoin->value/100 ?> рублей." disabled="">

                        <div class="help-block"></div>
                    </div>

                    <!-- Инпут с пересчетом биткоина на рубли -->
                    <div class="form-group">
                        <label class="control-label">Введите интересующее количество биткоинов:</label>
                        <input class="form-control valute-course" id="bitkoin-refference" oninput="bitkoinConventer(this.value)" onchange="euroConventer(this.value)" value="">

                        <div class="help-block"></div>
                    </div>

                    <!-- Поле перессчета биткоина на рубли -->
                    <div class="form-group">
                        <label class="control-label">В рублях это составит:</label>
                        <input class="form-control valute-course" id="outputbitkoin" value="0 руб." disabled="">

                        <div class="help-block"></div>
                    </div>

                </div>
            <?php endif; ?>

            <div class="recommended-gm-content">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>

            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>

        </div>

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!-- Виджет Вконтакте -->
            <div class="vk-widget-styling">
                <?= $this->render('/other/wk-widget'); ?>
            </div>

            <!-- Виджет Discord -->
            <div>
                <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                    <?= $this->render('/other/discord-widget.php'); ?>
                <?php  $this->endCache(); } ?>
            </div>

            <?= $this->render('/other/yandex-donate.php'); ?>

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>
        </div>

    </div>
</div>
