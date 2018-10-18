<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 17.10.2018
 * Time: 12:24
 */

use app\components\AlertComponent;

$this->title = "Escape from Tarkov: Официальный список кланов";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Официальный список кланов зарегистрированный игроками по игре Escape from Tarkov',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Список кланов EQscape from Tarkov',
]);

?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Список кланов Escape from Tarkov</h1>
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

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>


        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 clans-content">

            <?php  if(Yii::$app->getSession()->getFlash('message')):?>
                <?=Yii::$app->getSession()->getFlash('message')?>
            <?php endif;?>
            
            <p class="size-16 alert alert-info">
                На этой странице представлена база кланов собственноручно зарегистрированная игроками Escape from Tarkov. В день рассматривается не больше <?=$countdaylimit?> заявок, также это число является дневным лимитом на количество заявок.
            <br>
            <br>
                В настоящий момент это наиболее полная <b>официальная база кланов</b> по игре Escape from Tarkov.
            </p>

            <?php if($avialableTickets <= 0): ?>
                <p class="size-16 alert alert-danger margin-top-20">Лимит заявок на регистрацию уже был достигнут, вы сможете заполнить заявку завтра.</p>
            <?php else: ?>
                <p class="size-16 alert alert-info margin-top-20">Заявок доступно для отправки - <b style="color: green"><?= $avialableTickets ?></b></p>
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
                        <i class="fa fa-check-circle checked-by-admins" title="Клан проверен администрацией tarkov-wiki.ru"></i>
                    </h3>

                    <!-- 100x100 -->
                    <img class="clan-img" src="<?=$clan['preview']?>" alt="<?= $clan['title'] ?>">

                    <p class="size-16"><?=$clan['description']?></p>

                    <p class="clan-community-link">Ссылка на сообщество клана: <a class="clan-community-link" href="<?=$clan['link']?>" rel="nofollow" target="_blank">Перейти в сообщество</a></p>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>


        <!-- right menu start -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!-- Виджет Вконтакте -->
            <div class="vk-widget-styling">
                <?= $this->render('/other/wk-widget'); ?>
            </div>

            <!-- Виджет дискорда -->
            <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
                <?php  $this->endCache(); } ?>

            <?= $this->render('/other/yandex-donate.php'); ?>

        </div>
        
        
    </div>
</div>