<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bereg}}`.
 */
class m220813_181656_create_bereg_table extends Migration
{
    const TABLE_NAME = 'bereg';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('ID primary key'),
            'name' => $this->string(100)->comment('Название маркера'),
            'marker_group' => $this->string(100)->Null()->comment('Группа маркера'),
            'coords_x' => $this->float()->Null()->comment('Координаты маркера по оси X'),
            'coords_y' => $this->float()->Null()->comment('Координаты маркера по оси Y'),
            'content' => $this->text()->Null()->comment('Содержимое маркера'),
            'enabled' => $this->integer(1)->Null()->comment('Активность маркера'),
            'customicon' => $this->string(255)->Null()->comment('Кастомная иконка маркера'),
            'exits_group' => $this->string(100)->Null()->comment('Группа выхода с локации'),
            'exit_anyway' => $this->integer()->Null()->comment('Флаг активности выходы с локации с 2-х сторон'),
            'date_update' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата создания маркера')
        ]);

        $this->addCommentOnTable(static::TABLE_NAME, "В этой таблице хранятся маркеры локации Берег");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE_NAME);
    }
}
