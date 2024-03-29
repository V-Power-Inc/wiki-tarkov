<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 30.09.2018
 * Time: 0:17
 */

use yii\web\JqueryAsset;
use app\models\Barters;

/**
 * @var Barters $barter - AR объект бартера
 * @var int $id - id бартера торговца
 */

$this->registerJsFile('js/news.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/questions.js', ['depends' => [JqueryAsset::class]]);

$this->title = 'Предпросмотр: '.$barter->title;
?>
<style>
    img.image-link {
        border: 1px solid white;
        box-shadow: 1px 1px 6px 2px;
    }

    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-bottom: 2px solid black;
    }
</style>

<div class="container">
    <div class="row">

        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <div class="news-shortitem bg-white">

                <div class="text-left">
                    <p>Страница предпросмотра зарендерилась:</p>
                </div>

                <div class="barters-block">
                        <!-- Табы -->
                        <ul class="nav nav-tabs barters">
                            <li><a data-toggle="tab" class="<?=$id?>" href="#<?=$id?>"><?=$barter->site_title ?></a></li>
                        </ul>

                        <!-- Контент табов -->
                        <div class="tab-content">
                            <div id="<?=$id?>" class="tab-pane fade in">
                                <h3><?=$barter[Barters::ATTR_TITLE]?></h3>
                                <p><?=$barter[Barters::ATTR_CONTENT]?></p>
                            </div>
                        </div>

                </div>

            </div>

        </div>

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

        </div>

    </div>
</div>