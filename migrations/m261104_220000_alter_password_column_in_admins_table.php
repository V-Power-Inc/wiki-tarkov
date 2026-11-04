<?php

use yii\db\Migration;

/**
 * Расширяем колонку с паролем админов под современные хеши (bcrypt - 60 символов, с запасом под argon2)
 * Старые sha1-хеши (40 символов) остаются рабочими и перезаписываются на новые при первом входе пользователя
 *
 * Class m261104_220000_alter_password_column_in_admins_table
 */
class m261104_220000_alter_password_column_in_admins_table extends Migration
{
    /** @var string - Название таблицы */
    private const TABLE_NAME = 'admins';

    /** @var string - Название колонки */
    private const COLUMN_NAME = 'password';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** Расширяем колонку до 255 символов */
        $this->alterColumn(self::TABLE_NAME, self::COLUMN_NAME, $this->string(255)->notNull()->comment('Хеш пароля'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /** Возвращаем 45 символов - ВНИМАНИЕ: новые bcrypt-хеши (60 символов) при откате будут обрезаны и перестанут работать */
        $this->alterColumn(self::TABLE_NAME, self::COLUMN_NAME, $this->string(45)->notNull()->comment('Пароль'));
    }
}
