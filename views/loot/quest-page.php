<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 07.03.2018
 * Time: 0:06
 */

use app\components\LeftmenuWidget;
use yii\widgets\LinkPager;
use app\components\AlertComponent;
use Yii;

$this->title = 'Квестовые предметы Escape from Tarkov';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Квестовые предметы в Escape from Tarkov енобьходимые для прохождения квестов торговцев а также поднятия репутации с торговцами.',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Квестовы предметы в Таркове, квестовые предметы Escape from Tarkov',
]);

$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/fix-img-blocks.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

use yii\bootstrap\ActiveForm;
?>


<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Квестовые предметы Escape from Tarkov</h1>
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
        
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <ul class="nav nav-pills nav-stacked categories categories-menu" id="categories-menu">
                <?= LeftmenuWidget::widget(['tpl' => 'leftmenu']) ?>
            </ul>

            <br>
            
            <p><a class="btn btn-default main-link" href="/loot/quest-loot" style="width: 100%;">Квестовые предметы</a></p>

            <!-- Виджет Discord -->
            <div class="margin-top-20">
                <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                    <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
                <?php  $this->endCache(); } ?>
            </div>

            <?= $this->render('/other/yandex-donate.php'); ?>

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">

            <!-- Описание категории -->
            <p class="alert alert-info size-16">
                В этом разделе, вы сможете узнать все о квестовых предметах, которые необходимы для прохождения квестов торговцев в Escape from Tarkov.
            <br>
            <br>
                Для вашего удобства, предметы привязаны к каждому из торговцев, у которых они будут необходимы для прохождения квестов, чтобы найти интересующие вас квестомые предметы, вы можете воспользоваться поиском.
            </p>

            <div class="col-lg-12">

            <?php if(!$form_model->load(Yii::$app->request->post())) : ?>
                
                <!-- Форма без $_POST -->
                <span class="key-selector">Искать квестовые предметы по торговцу:</span>
                <?php $form = ActiveForm::begin(['options' => ['action' => ['loot/questloot']],'id' => 'questloot','method' => 'post',]) ?>
                <?= $form->field($form_model, 'questitem')->dropDownList([
                    'Все предметы' => 'Все предметы',
                    'Прапор' => 'Прапор',
                    'Терапевт' => 'Терапевт',
                    'Скупщик' => 'Скупщик',
                    'Лыжник' => 'Лыжник',
                    'Миротворец' => 'Миротворец',
                    'Механик' => 'Механик',
                    'Барахольщик' => 'Барахольщик'
                ]);
                ?>
                <button type="submit" id="submitform" class="btn btn-primary h-37">Осуществить поиск...</button>
                <?php $form = ActiveForm::end() ?>
                
            <?php elseif($form_model->load(Yii::$app->request->post())) : ?>
                
                <!-- Форма с $_POST -->
                <span class="key-selector">Искать квестовые предметы по торговцу:</span>
                <?php $form = ActiveForm::begin(['options' => ['action' => ['loot/questloot']],'id' => 'questloot','method' => 'post',]) ?>
                <?= $form->field($form_model, 'questitem')->dropDownList([
                    'Все предметы' => 'Все предметы',
                    'Прапор' => 'Прапор',
                    'Терапевт' => 'Терапевт',
                    'Скупщик' => 'Скупщик',
                    'Лыжник' => 'Лыжник',
                    'Миротворец' => 'Миротворец',
                    'Механик' => 'Механик',
                    'Барахольщик' => 'Барахольщик'
                ],
                [
                    'value' => $arr
                ]);
                ?>
                <button type="submit" id="submitform" class="btn btn-primary h-37">Осуществить поиск...</button>
                <?php $form = ActiveForm::end() ?>
                
            <?php endif; ?>
            </div>
            
        

            <?php if($form_model->load(Yii::$app->request->post())) : ?>
                <?php if(empty($questsearch)) : ?>
                    <!-- Нет лута -->
                    <div class="col-lg-12">
                        <p class="alert alert-danger size-16">Предметы соответствующие критериям не были найдены. Возможно, они еще на стадии заполнения.</p>
                    </div>
                    <!-- Нет лута -->
                <?php endif; ?>
                    <?php foreach ($questsearch as $item) : ?>
                        <div class="col-lg-12">
                            <div class="item-loot">
                                <h2 class="item-loot-title"><a href="/loot/<?= $item['url'] ?>.html"><?= $item['title'] ?></a></h2>
                                <a class="loot-link" href="/loot/<?= $item['url'] ?>.html">
                                    <div class="fixies-float-image">
                                        <img class="loot-image" alt="<?= $item['title'] ?>" src="<?= $item['preview'] ?>">
                                    </div>
                                </a>
                                <p class="loot-description"><?= $item['shortdesc'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
            <?php else : ?>
                    <?php foreach ($allquestitems as $item) : ?>
                        <div class="col-lg-12">
                            <div class="item-loot">
                                <h2 class="item-loot-title"><a href="/loot/<?= $item['url'] ?>.html"><?= $item['title'] ?></a></h2>
                                <a class="loot-link" href="/loot/<?= $item['url'] ?>.html"><img class="loot-image" alt="<?= $item['title'] ?>" src="<?= $item['preview'] ?>"></a>
                                <p class="loot-description"><?= $item['shortdesc'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
            <?php endif; ?>
            
        </div>

        <div class="recommended-gm-content">
            <?= $this->render('/other/google-recommended.php'); ?>
        </div>
        
        <!-- Расстояние - заглушка -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-25"></div>

        <!-- Комментарии -->
        <?php if(empty($_GET)) : ?>
            <div id="mc-container" class="kek-recustom"></div>
            <script type="text/javascript">
                cackle_widget = window.cackle_widget || [];
                cackle_widget.push({widget: 'Comment', id: 57165});
                (function() {
                    var mc = document.createElement('script');
                    mc.type = 'text/javascript';
                    mc.async = true;
                    mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
                })();
            </script>
        <?php endif; ?>
        
    </div>
</div>