<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 06.01.2018
 * Time: 21:31
 */

namespace app\components;

use app\models\Doorkeys;
use app\models\News;
use app\models\Articles;
use app\models\Traders;
use yii\web\UrlRuleInterface;
use yii\base\BaseObject;
use yii\web\UrlManager;
use yii\web\Request;
use yii\base\InvalidConfigException;

/**
 * Url компонент для маршрутизации на детальные страницы некоторых коллекций объектов
 * (Новости, Ключи, Полезные материалы, Детальные страницы торговцев)
 *
 * Class UrlComponent
 * @package app\components
 */
final class UrlComponent extends BaseObject implements UrlRuleInterface
{
    /** @var int - Константа, первый элемент массива */
    private const FIRST_ELEMENT = 0;

    /**
     * Метод парсит запрос и возвращает маршрут в зависимости от заданной логики или вернет false
     * если с помощью указанной логики не смог собрать правильный маршрут
     *
     * @param UrlManager $manager
     * @param Request $request
     * @return array|bool
     * @throws InvalidConfigException
     */
    public function parseRequest($manager, $request)
    {
        /** Информация об URL адресе - все что идет после домена */
        $pathInfo = $request->getPathInfo();

        /** Разбиваем строку с урлом по слешам, чтобы выполнить проверки на соответствие разделам */
        $exploded_url = explode('/',$pathInfo);

        /** Если первый элемента массива - keys, значит мы в разделе ключей */
        if ($exploded_url[static::FIRST_ELEMENT] == 'keys'){

            /** Регулярка на совпадение - отправит на детальную страницу, в случае если удастся извлечь нужный параметр */
            if (preg_match('%([\w\-]+)([\/])([\w\-]+)$%', $pathInfo, $matches)) {

                /** Отправляем в контроллер с нужным параметром для Action */
                return ['site/doorkeysdetail', ['id'=>$matches[3]]];
            }
        } elseif ($exploded_url[static::FIRST_ELEMENT] == 'news') { /** Если первый элемента массива - news, значит мы в разделе новостей */

            /** Регулярка на совпадение - отправит на детальную страницу, в случае если удастся извлечь нужный параметр */
            if (preg_match('%([\w\-]+)([\/])([\w\-]+)$%', $pathInfo, $matches)) {

                /** Отправляем в контроллер с нужным параметром для Action */
                return ['site/newsdetail', ['id'=>$matches[3]]];
            }
        } elseif ($exploded_url[static::FIRST_ELEMENT] == 'articles') { /** Если первый элемента массива - articles, значит мы в разделе статей */

            /** Регулярка на совпадение - отправит на детальную страницу, в случае если удастся извлечь нужный параметр */
            if (preg_match('%([\w\-]+)([\/])([\w\-]+)$%', $pathInfo, $matches)) {

                /** Отправляем в контроллер с нужным параметром для Action */
                return ['site/articledetail',['url'=>$matches[3]]];
            }
        } elseif ($exploded_url[static::FIRST_ELEMENT] == 'traders') { /** Если первый элемента массива - traders, значит мы в разделе торговцев */

            /** Регулярка на совпадение - отправит на детальную страницу, в случае если удастся извлечь нужный параметр */
            if (preg_match('%([\w\-]+)([\/])([\w\-]+)$%', $pathInfo, $matches)) {

                /** Отправляем в контроллер с нужным параметром для Action */
                return ['trader/tradersdetail',['id'=>$matches[3]]];
            }
        } elseif ($exploded_url[static::FIRST_ELEMENT] == 'skills') { /** Если первый элемента массива - skills, значит мы в разделе умений */

            /** Регулярка на совпадение - отправит на детальную страницу или категорию, в случае если удастся извлечь нужный параметр */
            if (preg_match('%^([\-\w\d]+)([\/]{1})([\-\w\d]+)([\/]{1})([\-\w\d]+)([.html]+)$%',$request->pathInfo, $matches)) {

                /** Отправляем в контроллер с нужным параметром для Action - дательная страница умения */
                return ['skills/skillsdetail', ['url' => $matches[5]]];

            } elseif (preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) {

                /** Отправляем в контроллер с нужным параметром для Action - категория */
                return ['skills/skillscategory',['name'=>$matches[3]]];

            }
        } elseif ($exploded_url[static::FIRST_ELEMENT] == 'loot') { /** Если первый элемента массива - loot, значит мы в разделе лута */

            /** Регулярка на совпадение - отправит на детальную страницу, категорию или подкатегорию в случае если удастся извлечь нужный параметр */
            if (preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) { /** Вытащили параметр для подкатегории */

                /** Отправляем в контроллер с нужным параметром для Action - подкатегория */
                return ['loot/category',['name'=>$matches[5]]];

            } elseif (preg_match('%^([\w\-]+)([\/]{1})([\-\w\d]+)$%',$request->pathInfo, $matches)) { /** Вытащили параметр для категории */

                /** Отправляем в контроллер с нужным параметром для Action - категория */
                return ['loot/category',['name'=>$matches[3]]];

            } elseif (preg_match('%^([\-\w\d]+)([\/]{1})([\-\w\d]+)([.html]+)$%',$request->pathInfo, $matches)) { /** Вытащили параметр для детальной страницы лута */

                /** Отправляем в контроллер с нужным параметром для Action - детальная страница лута */
                return ['item/detailloot', ['item' => $matches[3]]];
            }
        }

        /** Возвращаем false, если вышеупомянутые проверки не прошли должным образом */
        return false;
    }

    /**
     * Метод, который создает URL в зависимости от имеющихся параметров
     * Может вернуть валидный URL, если смог его собрать или false, если не смог собрать валидный URL
     *
     * @param UrlManager $manager - URL менеджер
     * @param string $route - URL маршрут
     * @param array $params - доп. параметры
     * @return bool|string
     */
    public function createUrl($manager, $route, $params)
    {
        /** Если смогли найти по урлу - Ключ от двери */
        if (Doorkeys::find()->where([Doorkeys::ATTR_URL => $route])->One()) {

            /** Возвращаем путь до детальной страницы */
            return 'keys/' . $route;

        } elseif (News::find()->where([News::ATTR_URL => $route])->One()){ /** Если смогли найти по урлу - Новость */

            /** Возвращаем путь до детальной страницы */
            return 'news/' . $route;

        } elseif(Articles::find()->where([Articles::ATTR_URL => $route])->One()) { /** Если смогли найти по урлу - Статья */

            /** Возвращаем путь до детальной страницы */
            return 'articles/' . $route;

        } elseif(Traders::find()->where([Traders::ATTR_URL => $route])->One()) { /** Если смогли найти по урлу - Торговец */

            /** Возвращаем путь до детальной страницы */
            return 'traders/' . $route;
        }

        /** Вернем false - если не одна из вышеупомянутых проверок не сработала */
        return false;
    }
}