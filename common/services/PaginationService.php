<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 12.08.2022
 * Time: 16:21
 */

namespace app\common\services;

use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use Yii;

/**
 * Сервис помогает проще реализовывать пагинацию
 *
 * Class PaginationService
 * @package app\common\services
 */
final class PaginationService
{
    /** @var int defaultPageSize - кол-во элементов на странице по умолчанию  */
    const defaultPageSize = 20;

    /** @var Pagination $paginator */
    public $paginator;

    /** @var array|ActiveRecord $items - переменная для хранения набора объектов */
    public $items;

    /**
     * Метод construct объект пагинатора и возвращает полноценный запрос
     * для рендеринга на конечной странице
     *
     * @param ActiveQuery $query - базовый запрос на получение данных
     * @param int $pageSize - количество элементов на странице
     * @return $this
     */
    public function __construct(ActiveQuery $query, int $pageSize = self::defaultPageSize)
    {
        /** Задаем атрибуту класса - экземпляр пагинатора */
        $this->paginator = new Pagination(['totalCount' => $query->count()]);

        /** Задаем пагинатору размер страницы (По-умолчанию 20, если не было параметра) */
        $this->paginator->setPageSize($pageSize);

        /** Сетапим атрибуту этого класса конечный запрос на выборку данных (С кешем на 1 час) */
        $this->items = $query->offset($this->paginator->offset)
            ->orderby(['date_create'=>SORT_DESC])
            ->limit($this->paginator->limit)
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();

        /** Возвращаем текущий экземпляр класса */
        return $this;
    }
}