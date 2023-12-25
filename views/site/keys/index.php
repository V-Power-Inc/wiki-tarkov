<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 04.01.2018
 * Time: 22:20
 */

use yii\bootstrap\ActiveForm;
use app\models\Doorkeys;

$this->title = 'Справочник ключей Escape from Tarkov. Ключи от дверей в Таркове';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Справочник ключей Escape from Tarkov. Ключи от помещений в Таркове',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Ключ от комнаты Тарков, Тарков база ключей, база ключей Escape from Tarkov',
]);

/**
 * @var $form_model Doorkeys
 * @var $terralab Doorkeys - ключи от дверей для локации лаборатория TerraGroup
 * @var $tamojnya Doorkeys - ключи от дверей для локации лаборатория Таможня
 * @var $zavod Doorkeys - ключи от дверей для локации лаборатория Завод
 * @var $forest Doorkeys - ключи от дверей для локации лаборатория Лес
 * @var $bereg Doorkeys - ключи от дверей для локации лаборатория Берег
 * @var $razvyazka Doorkeys - ключи от дверей для локации лаборатория Развязка
 */
?>
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

                    <?php $form = ActiveForm::begin(['options' => ['action' => ['site/keys']],'id' => 'mapsearch','method' => 'post',]) ?>

                    <?= $form->field($form_model, Doorkeys::DOORKEY)->dropDownList(Doorkeys::KeysCategories()); ?>

                <button type="submit" id="submitform" class="btn btn-primary h-37">Осуществить поиск...</button>
              
                
                <?php $form = ActiveForm::end() ?>
            </div>

            <!-- Блок контента - ключи на локации Лаборатории -->
            <div class="col-lg-12">
                <h2 class="keys-titles">Ключи на локации Лаборатория Terra Group</h2>
                <!-- Контентная часть ключей -->
                <?php foreach ($terralab as $zterralab => $k_terralab): ?>

                    <?php if(in_array($zterralab,Yii::$app->params['keysBlocks'])): ?>
                        <!-- feed recomendations -->
                        <div class="col-lg-12 item-loot">
                            <?= $this->render('/other/adsense-feed.php'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$k_terralab['url']?>"><?=$k_terralab['name']?></a></p>
                        <a href="/keys/<?=$k_terralab['url']?>"><img class="w-100 f-left fixible custom-key-margin" src="<?=$k_terralab['preview']?>"></a>
                        <div class="item-content"><?=$k_terralab['shortcontent']?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>

            <!-- Блок контента - ключи на локации Таможня -->
            <div class="col-lg-12">
                <h2 class="keys-titles">Ключи на локации Таможня</h2>
                <!-- Контентная часть ключей -->
                <?php foreach ($tamojnya as $ztamojnya => $k_tamojnya): ?>
                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$k_tamojnya['url']?>"><?=$k_tamojnya['name']?></a></p>
                        <a href="/keys/<?=$k_tamojnya['url']?>"><img class="w-100 f-left fixible custom-key-margin" src="<?=$k_tamojnya['preview']?>"></a>
                        <div class="item-content"><?=$k_tamojnya['shortcontent']?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>
            
            <!-- Блок контента ключи на локации Завод -->
            <div class="col-lg-12">
                <h2 class="keys-titles">Ключи на локации Завод</h2>
                <!-- Контентная часть ключей -->
                <?php foreach ($zavod as $kzavod => $k_zavod): ?>
                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$k_zavod['url']?>"><?=$k_zavod['name']?></a></p>
                        <a href="/keys/<?=$k_zavod['url']?>"><img class="w-100 f-left fixible custom-key-margin" src="<?=$k_zavod['preview']?>"></a>
                        <div class="item-content"><?=$k_zavod['shortcontent']?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>
            
            <!-- Блок контента ключи на локации Лес -->
            <div class="col-lg-12">
                <h2 class="keys-titles">Ключи на локации Лес</h2>
                <!-- Контентная часть ключей -->
                <?php foreach ($forest as $zforest => $k_forest): ?>
                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$k_forest['url']?>"><?=$k_forest['name']?></a></p>
                        <a href="/keys/<?=$k_forest['url']?>"><img class="w-100 f-left fixible custom-key-margin" src="<?=$k_forest['preview']?>"></a>
                        <div class="item-content"><?=$k_forest['shortcontent']?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>
            
            <!-- Блок контента ключи на локации Берег -->
            <div class="col-lg-12">
                <h2 class="keys-titles">Ключи на локации Берег</h2>
                <!-- Контентная часть ключей -->
                <?php foreach ($bereg as $zbereg => $k_bereg): ?>
                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$k_bereg['url']?>"><?=$k_bereg['name']?></a></p>
                        <a href="/keys/<?=$k_bereg['url']?>"><img class="w-100 f-left fixible custom-key-margin" src="<?=$k_bereg['preview']?>"></a>
                        <div class="item-content"><?=$k_bereg['shortcontent']?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>
       

            <!-- Блок контента ключи на локации Развязка -->
            <div class="col-lg-12">
                <h2 class="keys-titles">Ключи на локации Развязка</h2>
                <!-- Контентная часть ключей -->
                <?php foreach ($razvyazka as $zrazvyazka => $k_razvyazka): ?>
                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$k_razvyazka['url']?>"><?=$k_razvyazka['name']?></a></p>
                        <a href="/keys/<?=$k_razvyazka['url']?>"><img class="w-100 f-left fixible custom-key-margin" src="<?=$k_razvyazka['preview']?>"></a>
                        <div class="item-content"><?=$k_razvyazka['shortcontent']?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>
            
            <div class="col-lg-12">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>
        </div>

    </div>
</div>