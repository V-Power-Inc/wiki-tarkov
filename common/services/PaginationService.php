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
 * Совместим лишь с частью Active Record моделей
 *
 * Class PaginationService
 * @package app\common\services
 */
final class PaginationService
{
    /** @var string - Константа, название атрибута даты создания записи у большинства AR моделей */
    private const ATTR_DATE_CREATE = 'date_create';

    /** @var int defaultPageSize - кол-во элементов на странице по умолчанию  */
    private const defaultPageSize = 20;

    /** @var Pagination $paginator - Объект класса пагинации */
    public Pagination $paginator;

    /** @var array|ActiveRecord[] $items - переменная для хранения набора объектов */
    public array $items;

    /**
     * Метод construct объект пагинатора и возвращает полноценный запрос
     * для рендеринга на конечной странице
     *
     * @param ActiveQuery $query - базовый запрос на получение данных
     * @param int $pageSize - количество элементов на странице
     * @param bool $cache - Флаг кеша, по умолчанию активен
     * @return $this
     */
    public function __construct(ActiveQuery $query, int $pageSize = self::defaultPageSize, bool $cache = true)
    {
        /** Сетапим атрибуту пагинации - объект пагинации */
        $this->paginator = new Pagination(['totalCount' => $query->count()]);

        /** Сетапим пагинатору размер страницы (По-умолчанию 20, если не было параметра) */
        $this->paginator->setPageSize($pageSize);

        /** Если кеш установлен как true - будет запрос с кешированием на 1 час */
        if ($cache) {
            $this->items = $query->offset($this->paginator->offset)
                ->orderby([self::ATTR_DATE_CREATE => SORT_DESC])
                ->limit($this->paginator->limit)
                ->cache(Yii::$app->params['cacheTime']['one_hour'])
                ->all();
        } else { /** Если флаг кеша как false - показываем данные без кеша */
            $this->items = $query->offset($this->paginator->offset)
                ->orderby([self::ATTR_DATE_CREATE => SORT_DESC])
                ->limit($this->paginator->limit)
                ->all();
        }

        /** Возвращаем экземпляр текущего класса */
        return $this;
    }
}