<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 17.10.2018
 * Time: 12:24
 */

use app\components\AlertComponent;
use yii\widgets\ActiveForm;

$this->title = "Escape from Tarkov: Зарегистрировать новый клан";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Escape from Tarkov: Зарегистрировать новый клан',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Escape from Tarkov: Зарегистрировать новый клан',
]);

?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Регистрация клана Escape from Tarkov</h1>
    </div>
</div>

<hr class="grey-line">

<?php if((AlertComponent::alert()->enabled !== 0)) : ?>
    <!-- Информационная строка -->
    <div class="row">
        <div class="container">
            <div class="col-lg-12 <?= AlertComponent::alert()->bgstyle ?>">
                <marquee style="font-size: 16px; color: white; font-weight: bold; margin-top: 4px;"><?= AlertComponent::alert()->content ?></marquee>
            </div>
        </div>
    </div>
    <hr class="grey-line">
<?php endif; ?>



<div class="container">
    <div class="row">
        
        <div class="col-lg-12 clans-content special-border">

            <?php  if(Yii::$app->getSession()->getFlash('message')):?>
                <?=Yii::$app->getSession()->getFlash('message')?>
            <?php endif;?>
            
            <?php $form = ActiveForm::begin(['action' => '/clan/save', 'options' => ['method' => 'post'], 'id' => 'reg-new-clan']); ?>

                <div class="col-lg-4">
                    <?= $form->field($model, 'title')->textInput() ?>
                </div>
    
                <div class="col-lg-4">
                    <?= $form->field($model, 'description')->textInput() ?>
                </div>
    
                <div class="col-lg-4">
                    <button class="btn btn-primary" id="upl-clan-logo" type="button">Загрузить логотип клана</button>
                    <?= $form->field($model, 'file')->fileInput(['class' => 'vs-none'])->label('') ?>
                </div>
    
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success">Зарегистрировать клан</button>
                </div>

            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
</div>
