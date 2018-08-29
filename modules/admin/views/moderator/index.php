<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.08.2018
 * Time: 22:28
 */


/*** Вьюха рендерит страницу модерации пользователей сайта ***/

$this->title = 'Модерация пользователей админки';

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>

<?php  if(Yii::$app->getSession()->getFlash('message')):?>
    <?=Yii::$app->getSession()->getFlash('message')?>
<?php endif;?>

<h1 class="moderator-title"><?= $this->title ?></h1>

<div class="alert alert-info size-16">На данный момент в системе существует
    <span class="count-users"><?=$countusers?></span> администраторов из которых
    <span class="user-traitor"><?= $bannedusers ?></span> постигла <b>кара за предательство</b>.
    <br>
    <br>
    Бан пользователя и отключение его от сайта производится через кнопку - бан с двух ног, после этой операции, пользователя разлогинивает
    и он больше не сможет зайти на сайт.
</div>

<a class="btn btn-primary" href="/admin">Вернуться на главную в админку</a>


<div class="row">



    <?php if (isset(Yii::$app->user->identity->id)): ?>
        <?php if(Yii::$app->user->identity->id === 1 || Yii::$app->user->identity->id === 2): ?>
            <!-- Регистрация нового пользователя -->
                <div class="col-lg-6">
                    <div class="admin-register-new-user">

                        <h2 class="text-center">Добавление нового пользователя</h2>

                        <?php $form = ActiveForm::begin(['action' => '/admin/moderator/user-save','options' => ['method' => 'post'],'id' => 'create-lot-form']); ?>

                        <?= $form->field($users, 'user', ['enableAjaxValidation' => true])->textInput(['placeholder' => "Логин пользователя, с ним он авторизуется на сайте"])->label('Логин пользователя') ?>

                        <?= $form->field($users, 'password')->textInput(['placeholder' => "Придумать ему пароль - любые символы (Только латинские)"])->label('Пароль пользователя') ?>

                        <?= $form->field($users, 'role')->textInput(['placeholder' => "Написать чем он занимается на сайте"])->label('Роль пользователя на сайте') ?>

                        <?= $form->field($users, 'name')->textInput(['placeholder' => "Написать как его зовут в реальной жизни"])->label('Имя пользователя') ?>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success submit-btn-reg">Добавить нового пользователя</button>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Баним с двух ног существующего пользователя -->
        <div class="col-lg-6">
            <div class="ban-existing-user">

                <h2 class="text-center">Раздача банов</h2>

                <p class="alert alert-danger size-16">При бане пользователю устанавливается статус, что он <b>забанен</b> а также сбрасываются его <b>логин</b> и <b>пароль</b>.</p>

                <?php $form = ActiveForm::begin(['action' => '/admin/moderator/user-ban','options' => ['method' => 'post'],'id' => 'create-lot-form']); ?>

                <?= $form->field($users, 'name')->dropDownList(ArrayHelper::map($active_users, 'id', 'name')) ?>

                <div class="form-group">
                    <button type="submit" class="btn btn-danger"><b>Бан с двух ног</b></button>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

</div>



    <!-- Список информации по текущим пользователям -->
    <div class="existing-users">
        <p class="alert alert-info size-16">Ниже представлена информация по пользователям зарегистрированным в системе в данный момент.</p>
    </div>

    <!-- Таблица с информацией по существующим пользователям -->
    <table class="table user-information">
        <thead>
        <tr>
            <th scope="col">Логин</th>
            <th scope="col">Роль</th>
            <th scope="col">Имя</th>
            <th scope="col">Статус учетки</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($array_users as $user): ?>
                <tr>
                    <td><?= $user['user'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= ($user['banned'] == 1)? '<label class="label label-danger">Пользователь забанен</label>':'<label class="label label-success">Активна</label>'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>




