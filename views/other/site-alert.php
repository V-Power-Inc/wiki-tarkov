<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 16:52
 *
 * Вьюха, которая в зависимости от активности компонента выводит его
 *
 */

use app\components\AlertComponent;
?>
<!-- Информационная строка -->
<div class="row">
    <div class="container">
        <div class="col-lg-12 <?= AlertComponent::alert()->bgstyle ?>">
            <marquee style="font-size: 16px; color: white; font-weight: bold; margin-top: 4px;"><?= AlertComponent::alert()->content ?></marquee>
        </div>
    </div>
</div>
<hr class="grey-line">