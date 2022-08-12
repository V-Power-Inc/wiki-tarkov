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
use Yii;
use yii\db\ActiveRecord;

/**
 * Сервис помогает проще реализовывать пагинацию
 * Совместим лишь с частью Active Record моделей
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
        $this->paginator = new Pagination(['totalCount' => $query->count()]);

        $this->paginator->setPageSize($pageSize);

        $this->items = $query->offset( $this->paginator->offset)
            ->orderby(['date_create'=>SORT_DESC])
            ->limit($this->paginator->limit)
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();

        return $this;
    }
}