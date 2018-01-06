<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 06.01.2018
 * Time: 21:41
 */

$this->title = 'Справочник ключей Escape from Tarkov: ' .$model['name'];
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model['description'],
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model['keywords'],
]);

$this->registerJsFile('js/keys-scripts.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>



<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading"><?=$model['name']?></h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">
        <div class="col-lg-12 keys-content">
            
            <div class="col-lg-12">
                
                    <div class="col-lg-12 item-key">
                        <img class="w-100 f-left" src="<?=$model['preview']?>">
                        <div class="item-content">
                            <p class="size-16">Ключ используется на локациях: <b><?=$model['mapgroup']?></b></p>
                            <?=$model['content']?>
                        </div>
                    </div>

                <a href="/keys"><button type="button" class="btn btn-primary">Вернуться в справочник ключей</button></a>
            </div>
           
    </div>
</div>
