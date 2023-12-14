<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 15.12.2023
 * Time: 0:00
 */

namespace app\common\services;

use Yii;

/**
 * Сервис для редиректов на канонические страницы приложения
 * Используется в случаях, когда в поисковые системы попадают дубли
 * Нюанс архитектуры, по многочисленным причинам на проекте не может использоваться strictParsing в UrlManager'e
 *
 * Class CanonicalPagesService
 * @package app\common\services
 */
final class CanonicalPagesService
{
    /**
     * Метод сравнивает запрашиваемый route со своей каноничной версией, если они не совпадают - редиректнет 301 запросом на каноникал урл
     * Этот метод можно использовать в случаях, когда в поисковые системы попали дубли страниц, хотя это редкий случай на этом проекте
     *
     * @param string $canonical_url - Канонический адрес страницы
     * @param string $requested_url - Url что запрашивал пользователь
     *
     * @return \yii\console\Response|\yii\web\Response|bool
     */
    public static function redirectToCanonical(string $canonical_url, string $requested_url)
    {
        /** Переменная для return'a */
        $result = false;

        /** Выдергиваем из канонического урла хост и все лишнее */
        $canonical_url = str_replace(Yii::$app->request->hostInfo, "",$canonical_url);

        /** Если url, который запросили не является частью канонического урла */
        if ($canonical_url !== $requested_url) {

            /** Возвращаем редиректом на канонический Url адрес */
            return Yii::$app->response->redirect($canonical_url, 301);
        }

        /** Возвращаем false - если редиректа не было */
        return $result;
    }
}