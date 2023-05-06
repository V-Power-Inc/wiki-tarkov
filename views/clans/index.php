<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 17.10.2018
 * Time: 12:24
 */

use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use app\models\Clans;

$this->title = "Escape from Tarkov: Список кланов";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Список кланов зарегистрированный игроками по игре Escape from Tarkov',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Список кланов Escape from Tarkov',
]);

$this->registerJsFile('js/search-clan.js', ['depends' => [JqueryAsset::class]]);

/** @var int $avialableTickets - Количество доступных для регистрации заявок */
/** @var Clans $srcclan - AR объект кланов */
?>
<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clans-content">

            <?php  if(Yii::$app->getSession()->getFlash('message')):?>
                <?=Yii::$app->getSession()->getFlash('message')?>
            <?php endif;?>
            
            <p class="size-16 alert alert-info">
                На этой странице представлена база кланов собственноручно зарегистрированная игроками Escape from Tarkov. В день рассматривается не больше <?=$countdaylimit?> заявок, также это число является дневным лимитом на количество заявок.
            <br>
            <br>
                В настоящий момент это наиболее полная <b>неофициальная база кланов</b> по игре Escape from Tarkov.
            <br>
            <br>
                <b class="bg-primary" style="padding: 5px;">5 April 2023 - Update:</b>  Все кланы у которых нет ссылки на сообщество будут отключены, новые кланы без ссылки на сообщество клана добавить невозможно. Если ваш клан исчез с этой страницы, напишите на почту <b>tarkov-wiki@ya.ru</b> и укажите название своего клана и ссылку на сообщество, либо заполните форму повторно.
            </p>

            <?php if($avialableTickets <= 0): ?>
                <p class="size-16 alert alert-danger margin-top-20">Лимит заявок на регистрацию уже был достигнут, вы сможете заполнить заявку завтра.</p>
            <?php else: ?>
                <p class="size-16 alert alert-info margin-top-20">Заявок доступно для отправки - <b style="color: green"><?= $avialableTickets ?></b></p>
            <?php endif; ?>
            

            <!-- searchform -->
            <?php if(!empty($clans)): ?>
                <?php $form = ActiveForm::begin(['action' => '#']); ?>
                    <?= $form->field($srcclan, 'searchclan')->textInput(['placeholder' => 'Введите название вашего клана']) ?>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>
            
            
            <?php if($avialableTickets <= 0): ?>
                <button class="btn btn-primary" disabled>Зарегистрировать клан</button>
            <?php else: ?>
                <a class="btn btn-primary" href="/add-clan">Зарегистрировать клан</a>
            <?php endif; ?>
            
            <?php if(empty($clans)): ?>
            <p class="size-16 alert alert-danger margin-top-20">В данный момент нет зарегистрированных кланов.</p>
            <?php else: ?>

            <?php foreach($clans as $clan): ?>
                <div class="clan-block">
                    <h3 class="clan-title">
                            <?= $clan['title'] ?>
                        <i class="fa fa-check-circle checked-by-admins" title="Клан проверен администрацией <?=$_ENV['DOMAIN']?>"></i>
                    </h3>

                   <?php if($clan['preview'] == null): ?>
                       <!-- 100x100 -->
                       <img class="clan-img" src="/img/qsch.png" alt="Логотип клана отсутствует">
                   <?php else: ?>
                        <!-- 100x100 -->
                        <img class="clan-img" src="<?=$clan['preview']?>" alt="<?= $clan['title'] ?>">
                   <?php endif; ?>
                        
                    <p class="size-16"><?=$clan['description']?></p>

                    <?php if($clan['link'] == null || $clan['link']==''): ?>
                        <label class="label label-danger">Клан не опубликовал ссылку на сообщество</label>
                        <br>
                        <br>
                    <?php else: ?>
                        <p class="clan-community-link">Ссылка на сообщество клана: <a class="clan-community-link" href="<?=$clan['link']?>" rel="nofollow" target="_blank">Перейти в сообщество</a></p>
                    <?php endif; ?>

                    <label class="label label-info date-clan-label">Клан зарегистрирован: <?= date("Y-m-d H:i:s", strtotime($clan['date_create'])) ?></label>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <!-- Блок комментариев -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <!-- Расстояние - заглушка -->
            <div class="height-25"></div>

            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>
        </div>


    </div>
</div>