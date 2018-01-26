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

class LeftmenuWidget extends Widget {
    
    public $tpl;

    /** Здесь хранятся все активные в базе категории **/
    public $data;

    /** Переменная для построения массива дерева с учетом вложенности активных категорий **/
    public $tree;

    /** Переменная хранит HTML шаблон выстроенный по полученным данным в зависимости от количества категорий в базе */
    public $menuHTML;
    
    public function init() {
        parent::init();
        if($this->tpl === null) {
           $this->tpl = 'leftmenu';
        }
        $this->tpl .='.php';
    }
    
    /** Получаем список всех активных категорий  **/
    public function run() {
        // Сначала пытаемся получить ранее закешированное меню
        // $menu = Yii::$app->cache->get('leftmenu');
        // if($menu) return $menu;
        
        $this->data = Category::find()->where(['enabled' => '1'])->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHTML = $this->getMenuHtml($this->tree);

        // Кэшируем данные
        // Yii::$app->cache->set('leftmenu', $this->menuHtml, 200);
        return $this->menuHTML;
    }

    /** Создаем массив "Дерево" из активных категорий **/
    protected function getTree() {
        $categoryTree = [];
        foreach ($this->data as $id=>&$node) {
            if(!$node['parent_category']) {
                $categoryTree[$id] = &$node;
            } else {
                $this->data[$node['parent_category']]['childs'][$node['id']] = &$node;
            }
        }
        return $categoryTree;
    }

    /** Рендерим шаблон html формы из массива дерева категорий */
    protected function getMenuHtml($categoryTree) {
        $resultHTML = '';
        foreach($categoryTree as $category) {
            $resultHTML .= $this->catToTemplate($category);
        }
        return $resultHTML;
    }

    /** Вывод готовой формы с категориями для браузера */
    protected function catToTemplate($category) {
        ob_start();
        include __DIR__ . '/render_views/' .$this->tpl;
        return ob_get_clean();
    }

}






