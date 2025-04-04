<?php

namespace app\common\traits;

/**
 * Трейт для обнуления имени формы
 */
trait FormNameTrait
{
    /**
     * Вместо имени формы - возвращаем пустую строку
     *
     * @return string
     */
    public function formName(): string
    {
        return '';
    }
}