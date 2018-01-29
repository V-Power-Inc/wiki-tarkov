<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 08.01.2018
 * Time: 16:51
 */
use yii\bootstrap\ActiveForm;
?>
    

    <div class="heading-class">
        <div class="container">
            <h1 class="main-site-heading">Справочник ключей Escape from Tarkov</h1>
        </div>
    </div>

    <hr class="grey-line">

    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 keys-content">
                <p class="size-16 alert alert-info">Наиболее полная база ключей от помещений в игре Escape from Tarkov. Данный справочник содержит информацию о всех доступных ключах от помещений Таркова на локациях Завод, Берег, Лес и Таможня. Также в этом разделе вы можете узнать что находится за открываемыми дверями и узнать где можно с большей вероятностью найти определенный ключи.</p>
                <div class="col-lg-12">
        
                    <span class="key-selector">Искать ключи на локации:</span>
                    <?php $form = ActiveForm::begin(['options' => ['action' => ['site/keysearch']],'id' => 'mapsearch','method' => 'post',]) ?>
        
                    <?= $form->field($form_model, 'doorkey')->dropDownList([
                        'Все ключи' => 'Все ключи',
                        'Таможня' => 'Таможня',
                        'Берег' => 'Берег',
                        'Лес' => 'Лес',
                        'Завод' => 'Завод',
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
                    <?php foreach ($keysearch as $keys): ?>
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
                <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
            </div>
        </div>
    </div>