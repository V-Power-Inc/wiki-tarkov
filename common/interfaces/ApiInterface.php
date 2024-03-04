<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 9:17
 */

namespace app\common\interfaces;

use app\models\forms\ApiForm;

/**
 * Интерфейс сервиса для работы с API tarkov.dev
 * В этом интерфейсе описаны методы, которые должны реализовывать выполнение различных задач
 * связанных с получением данных из API
 *
 * Всегда смотрим сюда, если нужно понять - какого типа данные мы на данный момент забираем из API
 *
 * Interface ApiInterface
 * @package app\common\interfaces
 */
interface ApiInterface
{
    /**
     * Метод должен возвращать боссов на конкретной локации а также список карт с боссами (если не было параметра)
     *
     * @param string|null $map_name - имя локации
     * @return mixed
     */
    function getBosses(string $map_name = null);

    /**
     * Метод для получения предметов из API по поисковому запросу из специальной формы
     * А также обработка кейсов, если предметы лута в БД у нас уже есть
     *
     * @param ApiForm $model - Объект поисковой формы Api
     * @return mixed
     */
    function proccessSearchItem(ApiForm $model);

    /**
     * Метод для получения квестов торговцев, в качестве параметра используется URL адрес квестов этого приложения
     *
     * @param string $url - URL до квестов торговцев
     * @return mixed
     */
    function getTasks(string $url);

    /**
     * Метод для получения исторических цен по сделкам продажи конкретного лута (предмета)
     *
     * @param string $id - id предмета из Api tarkov.dev
     * @return mixed
     */
    function getGraphsById(string $id);
}