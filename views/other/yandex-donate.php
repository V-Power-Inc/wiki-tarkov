<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 15.05.2018
 * Time: 18:43
 */
?>
<!-- Виджет формы доната -->
<?php if ($this->beginCache(Yii::$app->params['yandexCache'], ['duration' => 1])) { ?>
    <div style="padding-top: 10px;">
        <iframe src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=%D0%94%D0%BE%D0%BD%D0%B0%D1%82%D1%8B%20%D0%BD%D0%B0%20%D1%80%D0%B0%D0%B7%D0%B2%D0%B8%D1%82%D0%B8%D0%B5%20tarkov-wiki.ru&targets-hint=&default-sum=&button-text=12&payment-type-choice=on&hint=&successURL=https%3A%2F%2Ftarkov-wiki.ru&quickpay=shop&account=410016162855090" width="100%" height="313" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
    </div>
<?php  $this->endCache(); } ?>