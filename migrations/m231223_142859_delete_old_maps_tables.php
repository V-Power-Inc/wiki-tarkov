<?php

use yii\db\Migration;

/**
 * Этой миграцией дропаем таблицы и триггеры интерактивных карт локаций
 *
 * Class m231223_142859_delete_old_maps_tables
 */
class m231223_142859_delete_old_maps_tables extends Migration
{
    /** @var string - Константы названий таблиц для дропа/миграции */
    const ZAVOD_TABLE = 'zavod';
    const BEREG_TABLE = 'bereg';
    const LABORATORY_TABLE = 'laboratory';
    const RAZVYAZKA_TABLE = 'razvyazka';
    const FOREST_TABLE = 'forest';
    const TAMOJNYA_TABLE = 'tamojnya';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** Дропаем таблицу маркеров Завода */
        $this->dropTable(self::ZAVOD_TABLE);

        /** Дропаем таблицу маркеров Берега */
        $this->dropTable(self::BEREG_TABLE);

        /** Дропаем таблицу маркеров Развязки */
        $this->dropTable(self::RAZVYAZKA_TABLE);

        /** Дропаем таблицу маркеров Леса */
        $this->dropTable(self::FOREST_TABLE);

        /** Дропаем таблицу маркеров Таможни */
        $this->dropTable(self::TAMOJNYA_TABLE);

        /** Дропаем таблицу маркеров Лаборатории */
        $this->dropTable(self::LABORATORY_TABLE);

        /** Запрос на дроп миграции */
        $sql = "DROP TRIGGER IF EXISTS `trg-bereg`; DROP TRIGGER IF EXISTS `trg-zavod`; DROP TRIGGER IF EXISTS `trg-forest`; DROP TRIGGER IF EXISTS `trg-tamojnya`; DROP TRIGGER IF EXISTS `trg-razvyazka`; DROP TRIGGER IF EXISTS `trg-lab`;";

        /** Выполняем запрос */
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /** Создаем таблицу локации Завод */
        $this->createTable(static::ZAVOD_TABLE, [
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

        /** Коммент на таблицу */
        $this->addCommentOnTable(static::ZAVOD_TABLE, "В этой таблице хранятся маркеры локации Завод");

        /** Создаем таблицу локации Таможня */
        $this->createTable(static::TAMOJNYA_TABLE, [
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

        /** Коммент на таблицу */
        $this->addCommentOnTable(static::TAMOJNYA_TABLE, "В этой таблице хранятся маркеры локации Таможня");

        /** Создаем таблицу локации Берег */
        $this->createTable(static::BEREG_TABLE, [
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

        /** Коммент на таблицу */
        $this->addCommentOnTable(static::BEREG_TABLE, "В этой таблице хранятся маркеры локации Берег");

        /** Создаем таблицу локации Лес */
        $this->createTable(static::FOREST_TABLE, [
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

        /** Коммент на таблицу */
        $this->addCommentOnTable(static::FOREST_TABLE, "В этой таблице хранятся маркеры локации Лес");

        /** Создаем таблицу локации Развязка */
        $this->createTable(static::RAZVYAZKA_TABLE, [
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

        /** Коммент на таблицу */
        $this->addCommentOnTable(static::RAZVYAZKA_TABLE, "В этой таблице хранятся маркеры локации Развязка");


        /** Создаем таблицу локации Лаборатория */
        $this->createTable(static::LABORATORY_TABLE, [
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

        /** Коммент на таблицу */
        $this->addCommentOnTable(static::LABORATORY_TABLE, "В этой таблице хранятся маркеры локации Лаборатирия TerraGroup");

        /** Создаем триггер для таблицы завода */
        $this->createZavodTrigger();

        /** Создаем триггер для таблицы берега */
        $this->createBeregTrigger();

        /** Создаем триггер для таблицы леса */
        $this->createForestTrigger();

        /** Создаем триггер для таблицы Развязки */
        $this->createRazvyazkaTrigger();

        /** Создаем триггер для таблицы таможни */
        $this->createTamojnyaTrigger();

        /** Создаем триггер для таблицы лаборатории */
        $this->createLaboratoryTrigger();
    }

    /** Метод для создания триггера таблицы маркеров локации - Завод */
    private function createZavodTrigger()
    {
        /** SQL для создания триггера на таблицу zavod (обновление записей в БД) */
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-zavod` BEFORE UPDATE ON `zavod` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';

        /** Создаем триггер */
        $this->execute($sql);
    }

    /** Метод для создания триггера таблицы маркеров локации - Берег */
    private function createBeregTrigger()
    {
        /** SQL для создания триггера на таблицу bereg (обновление записей в БД) */
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-bereg` BEFORE UPDATE ON `bereg` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';

        /** Создаем триггер */
        $this->execute($sql);
    }

    /** Метод для создания триггера таблицы маркеров локации - Лес */
    private function createForestTrigger()
    {
        /** SQL для создания триггера на таблицу forest (обновление записей в БД) */
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-forest` BEFORE UPDATE ON `forest` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';

        /** Создаем триггер */
        $this->execute($sql);
    }

    /** Метод для создания триггера таблицы маркеров локации - Таможня */
    private function createTamojnyaTrigger()
    {
        /** SQL для создания триггера на таблицу tamojnya (обновление записей в БД) */
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-tamojnya` BEFORE UPDATE ON `tamojnya` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';

        /** Создаем триггер */
        $this->execute($sql);
    }

    /** Метод для создания триггера таблицы маркеров локации - Развязка */
    private function createRazvyazkaTrigger()
    {
        /** SQL для создания триггера на таблицу razvyazka (обновление записей в БД) */
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-razvyazka` BEFORE UPDATE ON `razvyazka` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';

        /** Создаем триггер */
        $this->execute($sql);
    }

    /** Метод для создания триггера таблицы маркеров локации - Лаборатория */
    private function createLaboratoryTrigger()
    {
        /** SQL для создания триггера на таблицу laboratory (обновление записей в БД) */
        $sql = 'CREATE DEFINER=`'. $_ENV['DB_USER'] .'`@`localhost` TRIGGER `trg-lab` BEFORE UPDATE ON `laboratory` FOR EACH ROW BEGIN
      SET NEW.date_update = CURRENT_TIMESTAMP;
     END';

        /** Создаем триггер */
        $this->execute($sql);
    }
}