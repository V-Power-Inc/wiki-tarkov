<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 08.01.2018
 * Time: 16:51
 */
use yii\bootstrap\ActiveForm;

$this->title = 'Справочник ключей Escape from Tarkov. Ключи от дверей в Таркове';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Справочник ключей Escape from Tarkov. Ключи от помещений в Таркове',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Ключ от комнаты Тарков, Тарков база ключей, база ключей Escape from Tarkov',
]);

$keysBlocks = [8,16];
?>
    

    <div class="heading-class">
        <div class="container">
            <h1 class="main-site-heading">Справочник ключей Escape from Tarkov</h1>
        </div>
    </div>

    <hr class="grey-line">

    <div class="container">
        <div class="row">

            <!-- no-scale -->
            <div class="col-lg-12">
                <?= $this->render('/other/google-gor.php'); ?>
            </div>
            
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 keys-content">
                <p class="size-16 alert alert-info">Наиболее полная база ключей от помещений в игре Escape from Tarkov. Данный справочник содержит информацию о всех доступных ключах от помещений Таркова на локациях Завод, Берег, Лес и Таможня. Также в этом разделе вы можете узнать что находится за открываемыми дверями и узнать где можно с большей вероятностью найти определенный ключи.</p>
                <div class="col-lg-12">
        
                    <span class="key-selector">Искать ключи на локации:</span>
                    <?php $form = ActiveForm::begin(['options' => ['action' => ['site/keysearch']],'id' => 'mapsearch','method' => 'post',]) ?>
        
                    <?= $form->field($form_model, 'doorkey')->dropDownList([
                        'Все ключи' => 'Все ключи',
                        'Лаборатория Terra Group' => 'Лаборатория Terra Group',
                        'Таможня' => 'Таможня',
                        'Берег' => 'Берег',
                        'Лес' => 'Лес',
                        'Завод' => 'Завод',
                        'Развязка' => 'Развязка',
                        '3-х этажная общага на Таможне' => '3-х этажная общага на Таможне',
                        '2-х этажная общага на Таможне' => '2-х этажная общага на Таможне',
                        'Восточное крыло санатория' => 'Восточное крыло санатория',
                        'Западное крыло санатория' => 'Западное крыло санатория',
                        'Ключи от техники' => 'Ключи от техники',
                        'Квестовые ключи' => 'Квестовые ключи',
                        'Ключи от сейфов/помещений с сейфами' => 'Ключи от сейфов/помещений с сейфами',
                    ],
                    [
                        'value' => $arr
                    ]);
                    ?>
        
                    <button type="submit" id="submitform" class="btn btn-primary h-37">Осуществить поиск...</button>
        
                    <?php $form = ActiveForm::end() ?>
                    
                </div>

                <div class="col-lg-12">
                    <h2>Найдены следующие ключи:</h2>
                </div>
                
                <div class="col-lg-12">
                    <!-- Контентная часть ключей -->
                    <?php foreach ($keysearch as $zkeys => $keys): ?>

                        <?php if(in_array($zkeys,$keysBlocks)): ?>
                            <!-- feed recomendations -->
                            <div class="col-lg-12 item-key fix-block">
                                <?= $this->render('/other/adsense-feed.php'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="col-lg-12 item-key">
                            <p class="item-name"><a href="/keys/<?=$keys['url']?>"><?=$keys['name']?></a></p>
                            <a href="/keys/<?=$keys['url']?>"><img class="w-100 f-left fixible custom-key-margin" src="<?=$keys['preview']?>"></a>
                            <div class="item-content"><?=$keys['shortcontent']?></div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Оконачание контентной части ключей -->
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                <!--Yandex direct -->
                <?= $this->render('/other/yandex-direct.php'); ?>

                <!-- Виджет Вконтакте -->
                <div class="vk-widget-styling">
                    <?= $this->render('/other/wk-widget'); ?>
                </div>

                <!-- Виджет дискорда -->
                <?= $this->render('/other/discord-widget.php'); ?>

                <?= $this->render('/other/yandex-donate.php'); ?>

            </div>
        </div>
    </div>
</div>