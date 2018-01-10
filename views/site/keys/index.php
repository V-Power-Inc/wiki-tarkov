<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 04.01.2018
 * Time: 22:20
 */

use yii\bootstrap\ActiveForm;

$this->registerJsFile('js/keys-scripts.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>


<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Справочник ключей Escape from Tarkov</h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">
        <div class="col-lg-12 keys-content">
            <p class="size-16 alert alert-info">Наиболее полная база ключей от помещений в игре Escape from Tarkov. Данный справочник содержит информацию о всех доступных ключах от помещений Таркова на локациях Завод, Берег, Лес и Таможня. Также в этом разделе вы можете узнать что находится за открываемыми дверями и узнать где можно с большей вероятностью найти определенный ключи.</p>

            <div class="col-lg-12">
                <span class="key-selector">Искать ключи на локации:</span>
                    <?php $form = ActiveForm::begin(['options' => ['action' => ['site/keys']],'id' => 'mapsearch','method' => 'post',]) ?>
                
<?= $form->field($form_model, 'doorkey')->dropDownList([
       'Все ключи' => 'Все ключи',
       'Таможня' => 'Таможня',
       'Берег' => 'Берег',
       'Лес' => 'Лес',
       'Завод' => 'Завод',
      ]); 
?>

                <button type="submit" id="submitform" class="btn btn-primary h-37">Осуществить поиск...</button>
              
                
                <?php $form = ActiveForm::end() ?>
            </div>

    <!-- Блок контента - ключи на локации Таможня -->
            <div class="col-lg-12">
                <h2 class="keys-titles">Ключи на локации Таможня</h2>
                <!-- Контентная часть ключей -->
                <?php foreach ($tamojnya as $k_tamojnya): ?>
                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$k_tamojnya['url']?>"><?=$k_tamojnya['name']?></a></p>
                        <a href="/keys/<?=$k_tamojnya['url']?>"><img class="w-100 f-left fixible" src="<?=$k_tamojnya['preview']?>"></a>
                        <div class="item-content"><?=$k_tamojnya['shortcontent']?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>
            
    <!-- Блок контента ключи на локации Завод -->
            <div class="col-lg-12">
                <h2 class="keys-titles">Ключи на локации Завод</h2>
                <!-- Контентная часть ключей -->
                <?php foreach ($zavod as $k_zavod): ?>
                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$k_zavod['url']?>"><?=$k_zavod['name']?></a></p>
                        <a href="/keys/<?=$k_zavod['url']?>"><img class="w-100 f-left" src="<?=$k_zavod['preview']?>"></a>
                        <div class="item-content"><?=$k_zavod['shortcontent']?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>
            
    <!-- Блок контента ключи на локации Лес -->
            <div class="col-lg-12">
                <h2 class="keys-titles">Ключи на локации Лес</h2>
                <!-- Контентная часть ключей -->
                <?php foreach ($forest as $k_forest): ?>
                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$k_forest['url']?>"><?=$k_forest['name']?></a></p>
                        <a href="/keys/<?=$k_forest['url']?>"><img class="w-100 f-left" src="<?=$k_forest['preview']?>"></a>
                        <div class="item-content"><?=$k_forest['shortcontent']?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>
            
    <!-- Блок контента ключи на локации Берег -->
            <div class="col-lg-12">
                <h2 class="keys-titles">Ключи на локации Берег</h2>
                <!-- Контентная часть ключей -->
                <?php foreach ($bereg as $k_bereg): ?>
                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$k_bereg['url']?>"><?=$k_bereg['name']?></a></p>
                        <a href="/keys/<?=$k_bereg['url']?>"><img class="w-100 f-left" src="<?=$k_bereg['preview']?>"></a>
                        <div class="item-content"><?=$k_bereg['shortcontent']?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>
        </div>
    </div>
</div>

