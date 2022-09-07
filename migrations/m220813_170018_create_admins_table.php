<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admins}}`.
 */
class m220813_170018_create_admins_table extends Migration
{
    const TABLE_NAME = 'admins';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'user' => $this->string(45)->comment('Логин администратора'),
            'password' => $this->string(45)->comment('Пароль администратора'),
            'captcha' => $this->string(255)->comment('Поле для капчи'),
            'remember_me' => $this->integer(1)->Null()->comment('Статус запоминания сессии'),
            'role' => $this->string(255)->Null()->comment('Роль пользователя среди администраторов'),
            'date_end' => $this->timestamp()->Null()->comment('Срок окончания прав администрирования'),
            'name' => $this->string(255)->Null()->comment('ФИО администратора или просто имя'),
            'banned' => $this->integer(1)->Null()->comment('Статус - забанен ли администратор'),
            'bann_reason' => $this->string(255)->Null()->comment('Причина по которой администратор был забанен')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "Таблица админов сайта");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
