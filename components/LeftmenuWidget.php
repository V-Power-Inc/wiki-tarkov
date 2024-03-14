<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 26.01.2018
 * Time: 23:35
 */

namespace app\components;
use yii\base\Widget;
use app\models\Category;
use Yii;

/**
 * Класс для постройки виджета в левом меню сайта
 *
 * Class LeftmenuWidget
 * @package app\components
 *
 * @author Mikhail Dimitrenko
 */
final class LeftmenuWidget extends Widget {

    /** @var string - Название файла, который содержит HTML шаблон меню */
    public $tpl;

    /** Здесь хранятся все активные в базе категории **/
    public $data;

    /** @var array - Переменная для построения массива дерева с учетом вложенности активных категорий **/
    public $tree;

    /** @var string - Переменная хранит HTML шаблон выстроенный по полученным данным в зависимости от количества категорий в базе */
    public $menuHTML;

    /** Метод инициализирует виджет */
    public function init()
    {
        /** Инициализация родительского виджета (Widget) */
        parent::init();

        /** Если не указан файл шаблона из которого брать меню */
        if ($this->tpl === null) {

            /** Указываем название файла */
           $this->tpl = 'leftmenu';
        }

        /** Указываем расширения файла */
        $this->tpl .='.php';
    }

    /**
     * Кешируем все запросы из БД - храним их в кеше
     *
     * @return array|array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => Yii::$app->params['cacheTime']['seven_days'],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM category',
                ],
            ],
        ];
    }

    /**
     * Получаем список всех активных категорий и строим корректную последовательность
     *
     * @return string
     */
    public function run(): string
    {
        /** Сетапи атрибуту класса - запрос на получение данных, активные категории */
        $this->data = Category::find()
            ->where([Category::ATTR_ENABLED => Category::TRUE])
            ->indexBy(Category::ATTR_ID)
            ->orderby([Category::ATTR_SORTIR => SORT_ASC])
            ->asArray()
            ->all();

        /** Сетапим атрибуту класса - построить дерево категорий */
        $this->tree = $this->getTree();

        /** Сетапим атрибуту класса - начать генерировать html блоки навигации с помощью готового дерева категорий */
        $this->menuHTML = $this->getMenuHtml($this->tree);

        /** Возвращаем конечный html для вывода на страницу */
        return $this->menuHTML;
    }

    /**
     * Создаем массив "Дерево" из активных категорий
     *
     * @return array
     */
    protected function getTree(): array
    {
        /** Массив для возвращение результата */
        $categoryTree = [];

        /** В цикле проходим массив категорий, что сформировать массив категорий - родители и их дочерние категории */
        foreach ($this->data as $id=>&$node) {
            if (!$node[Category::ATTR_PARENT_CATEGORY]) {
                $categoryTree[$id] = &$node;
            } else {
                $this->data[$node[Category::ATTR_PARENT_CATEGORY]]['childs'][$node[Category::ATTR_ID]] = &$node;
            }
        }

        /** Возвращаем массив с деревом категорий */
        return $categoryTree;
    }

    /**
     * Рендерим шаблон html формы из массива дерева категорий
     *
     * @param array $categoryTree - массив дерева категорий с родительскими и дочерними элементами
     * @return string
     */
    protected function getMenuHtml(array $categoryTree): string
    {
        /** Строка для выдачи результата */
        $resultHTML = '';

        /** В цикле проходим массив категорий (Родительских и дочерних )*/
        foreach($categoryTree as $category) {

            /** Нарезаем элементы в html */
            $resultHTML .= $this->catToTemplate($category);
        }

        /** Возвращаем конечный Html */
        return $resultHTML;
    }

    /**
     * Вывод готовой формы с категориями для браузера
     *
     * @param $category
     * @return false|string
     */
    protected function catToTemplate($category)
    {
        /** Используем буферизацию вывода */
        ob_start();

        /** Подключаем и исполняем этот файл (Шаблон левого меню сайта) */
        include __DIR__ . '/render_views/' .$this->tpl;

        /** Получем содержимое текущего буфера, после чего - удаляем его */
        return ob_get_clean();
    }
}
