<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 08.01.2018
 * Time: 16:51
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
 * @var Doorkeys $form_model
 * @var string $formValue
 * @var Doorkeys $keysearch
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
                <?php $form = ActiveForm::begin(['options' => ['action' => ['site/keysearch']],'id' => 'mapsearch','method' => 'post',]) ?>

                <!-- Форма поиска ключей по фильтрам -->
                <?= $form->field($form_model, Doorkeys::DOORKEY)->dropDownList(Doorkeys::KeysCategories(), ['value' => $formValue]); ?>

                <button type="submit" id="submitform" class="btn btn-primary h-37">Осуществить поиск...</button>

                <?php $form = ActiveForm::end() ?>

            </div>

            <div class="col-lg-12">
                <h2>Найдены следующие ключи:</h2>
            </div>

            <div class="col-lg-12">
                <!-- Контентная часть ключей -->
                <?php foreach ($keysearch as $zkeys => $keys): ?>

                    <?php if(in_array($zkeys,Yii::$app->params['keysBlocks'])): ?>
                        <!-- feed recomendations -->
                        <div class="col-lg-12 item-key fix-block">
                            <?= $this->render('/other/adsense-feed.php'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-12 item-key">
                        <p class="item-name"><a href="/keys/<?=$keys[Doorkeys::ATTR_URL]?>"><?=$keys[Doorkeys::ATTR_NAME]?></a></p>
                        <a href="/keys/<?=$keys[Doorkeys::ATTR_URL]?>"><img class="w-100 f-left fixible custom-key-margin" alt="<?=$keys[Doorkeys::ATTR_NAME]?>" src="<?=$keys[Doorkeys::ATTR_PREVIEW]?>"></a>
                        <div class="item-content"><?=$keys[Doorkeys::ATTR_SHORTCONTENT]?></div>
                    </div>
                <?php endforeach; ?>
                <!-- Оконачание контентной части ключей -->
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>
        </div>
    </div>
</div>
