<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 7:57
 */

namespace app\common\services;

use app\common\constants\api\Api;
use app\common\interfaces\ApiInterface;
use app\common\interfaces\ResponseStatusInterface;
use app\common\models\tasks\db\TaskModel;
use app\common\models\tasks\TasksResult;
use app\components\MessagesComponent;
use app\models\ApiLoot;
use app\models\ApiSearchLogs;
use app\models\Bosses;
use app\models\forms\ApiForm;
use app\models\Tasks;
use yii\db\StaleObjectException;
use yii\helpers\Json;
use yii\web\HttpException;

/**
 * Сервис предназначенный для работы с API tarkov.dev и получения необходимой информации с помощью
 * различного рода запросов к GraphQl
 *
 * Подробнее о том как создавать запросы на GraphQl (https://api.tarkov.dev)
 *
 * Class ApiService
 * @package app\common\services
 */
final class ApiService implements ApiInterface
{
    /** @var array - Атрибут с заголовками запроса */
    private $headers = ['Content-Type: application/json'];

    /** @var string - Атрибут с телом запроса */
    private $query = '';

    /** @var string - Атрибут с основным адресом для получения API */
    private $api_url = 'https://api.tarkov.dev/graphql';

    /** @var string - Атрибут с видом запроса (GET,POST и т.д.) */
    private $method = 'POST';

    /**
     * Конструктор при инициализации класса задает атрибуту класса объет APIQueries для применения
     * различных запросов к API
     *
     * ApiService constructor.
     */
    public function __construct()
    {
        /** Сетапим атрибуту класса - объект APIQueries для сетапа запросов к API */
        $this->query = new ApiQueries();
    }

    /**
     * Метод по получению информации о боссах Escape From Tarkov
     *
     * @param string|null $map_name - Название карты (Параметр может отсутствовать)
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Throwable in case delete failed.
     * @return mixed
     */
    public function getBosses(string $map_name = null)
    {
        /** Проверяем, если записи о боссах устарели - проводим следующие операции */
        if ($this->isOldBosses() | $this->isEmptyBosses()) {

            /** Удаляем устаревшую информацию - если даже 1 босс устарел, обновляем всю таблицу */
            $this->removeOldBosses();

            /** Задаем тело запроса для получения информации о боссах */
            $this->query = $this->query->setBossesQuery();

            /** Присваиваем результат запроса переменной */
            $content = $this->getApiData();

            /** Сохраняем все новые объекты о боссах */
            $this->saveData($content);
        }

        /** Проходим существующие данные и ставим флаги устаревания по мере необходимости */
        $this->setOldBosses();

        /** Возвращаем результат - если в параметр прилетело название карты, возвращаем набор информации о боссах
         * на этой карте, если параметра не было - возвращаем массив со списком карт и Url адресов до карт
         */
        return !empty($map_name) ? JsondataService::getBossData($map_name) : Bosses::getMapData();
    }

    /**
     * Метод проверяет устаревшие записи о боссах и возвращает bool результат
     *
     * @return bool
     */
   private function isOldBosses(): bool
    {
        /** Задаем SQL запрос переменной - ищем устаревшие записи */
        $bosses = Bosses::findAll([Bosses::ATTR_OLD => Bosses::TRUE]);

        /** Если найдены устаревшие боссы - возвращаем true, если нет false */
        if (!empty($bosses)) {

            /** Возвращаем true в случае, если в массиве есть боссы */
            return true;
        }

        /** Возвращаем false, если устаревшие боссы не были найдены */
        return false;
    }

    /**
     * Функция проверяет - пуста ли таблица с данными о боссах и возвращает bool результат
     * true - если таблица с боссами пуста и false, если нет
     *
     * @return bool
     */
    private function isEmptyBosses(): bool
    {
        return empty(Bosses::find()->all()) ? true : false;
    }

    /**
     * Метод удаляет всю информацию из таблицы
     *
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Throwable in case delete failed.
     * @return bool
     */
    private function removeOldBosses(): bool
    {
        /** Задаем SQL запрос переменной - ищем устаревшие записи */
        $bosses = Bosses::find()->all();

        /** В цикле проходим всех устаревших боссов и удаляем их */
        foreach ($bosses as $boss) {
            $boss->delete();
        }

        /** Возвращаем true - если удаление боссов прошло успешно */
        return true;
    }

    /**
     * Метод получает данные из удаленного источника по переданному параметру запроса
     *
     * @param bool $encoded - указание, раскодировать из JSON или нет, по умолчанию да
     * @return mixed
     * @throws HttpException
     */
    private function getApiData(bool $encoded = true)
    {
        /** Устанавливаем атрибуты запроса (Включая подавление любых ошибок) */
        $data = @file_get_contents($this->api_url, false, stream_context_create([
            'http' => [
                'method' => $this->method,
                'header' => $this->headers,
                'content' => Json::encode(['query' => $this->query]),
            ]
        ]));


        /** TODO: Пора логирующую таблицу начать использовать */
        /** Если не получили данных из API - выкидываем Exception */
        if ($data === false) {

            /** Выкидываем 404 с указанием что API не вернул данных */
            throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE, 'API не вернул данные, попробуйте зайти позже');
        }

        /** Возвращаем результат, либо раскодированный из JSON либо нет, в зависимости от переданного сюда флага */
        return $encoded ? Json::decode($data, true) : $data;
    }

    /**
     * Метод сохраняет данные в таблицу Bosses
     *
     * @param array $data - массив с данными о боссах
     * @return bool
     */
    private function saveData(array $data): bool
    {
        /** Проходим в цикле все полученные карты */
        foreach ($data[Api::ATTR_DATA][Api::ATTR_MAPS] as $map) {

            /** Создаем новый AR объект Bosses */
            $model = new Bosses();

            /** Присваиваем атрибуты */
            $model->map = $map[Api::ATTR_MAP_NAME];
            $model->bosses = Json::encode($map[Api::ATTR_BOSSES]);

            /** Передаем название карты в генератор Url */
            $model->url = TranslateService::mapUrlCreator($map[Api::ATTR_MAP_NAME]);

            /** Сохраняем новый объект данных о боссе */
            $model->save();
        }

        /** Возвращаем true - если сохранение прошло удачно */
        return true;
    }

    /**
     * Метод проверяет актуальность данных и если они устарели - помечает их на удаление
     *
     * @return bool
     */
    private function setOldBosses(): bool
    {
        /** Задаем переменную с выборкой боссов, которые еще актуальны */
        $bosses = Bosses::findAll([Bosses::ATTR_OLD => Bosses::FALSE]);

        /** В цикле проходим все соответствующие записи */
        foreach ($bosses as $boss) {

            /** Дата устаревания записи */
            $date = date('Y-m-d H:i:s', strtotime($boss->date_create . ' +1 month'));

            /** Если дата записи +1 месяца - меньше текущего времени - запись должна быть помечена на удаление */
            if ($date < date("Y-m-d H:i:s",time())) {

                /** Устанавливаем флаг старой записи */
                $boss->old = Bosses::TRUE;

                /** Сохраняем изменения */
                $boss->save();
            }
        }

        /** Возвращаем true если все прошло успешно */
        return true;
    }

    /**
     * Метод задает тело запроса, для получения данных о предметах
     *
     * @param string $itemName - имя предмета
     * @return void
     */
    public function setItemQuery(string $itemName): void
    {
        /** Задаем тело запроса для получения информации о предметах */
        $this->query = $this->query->setItemQuery($itemName);
    }

    /**
     * Задаем тело запрос, для получения из API информации о квестах торговцев
     * @return void
     */
    private function setTasksQuery(): void
    {
        /** Задаем тело запроса для получения информации о квестах */
        $this->query = $this->query->setTasksQuery();
    }

    /**
     * Вызывая этот метод - получаем данные о квестах конкретного торговца
     * - Если квестов в БД нет или устарели, удалим их
     * - Если квесты есть и нет устаревших, возвращаем их из базы по урлу торговца
     *
     * @param string $url - URL до квестов торговцев
     * @return mixed
     * @throws StaleObjectException
     * @throws HttpException
     * @throws \Throwable
     */
    public function getTasks(string $url)
    {
        /** Проверяем, если записи о квестах устарели или их нет - проводим следующие операции */
        if ($this->isOldTasks() | $this->isEmptyTasks()) {

            /** Удаляем устаревшие записи о квестах */
            $this->removeOldTasks();

            /** Сетапим запрос для API на получение информации о квестах */
            $this->setTasksQuery();

            /** Переменная для получения данных о квестах через API */
            $data = $this->getApiData();

            /** Отправляем массив с данными о квестах в метод, который сохранит их в БД */
            $this->createTasks($data);

        } else if (!$this->isEmptyTasks()) { /** Если таблица с квестами не пуста - помечаем устаревшие записи */

            /** Помечаем устаревшие квесты */
            $this->setOldTasks();
        }

        /** Получаем данные о квестах из таблицы Tasks */
        $result = new TasksResult(Tasks::getTasksData($url));

        /** Если есть квесты */
        if (!empty($result->_items)) {

            /** Возвращаем их во вьюху */
            return $result->_items;
        }

        /** Выкидываем 404 ошибку, если нет квестов */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE, 'Такая страница не существует.')  ;
    }

    /**
     * В этом методе, мы обрабатываем поисковый запрос на получение предмета и решаем как с ним поступать
     *
     * Обработаны следующие кейсы:
     * - Предмета нет в базе и в API
     * - Предмета нет в базе но есть в API
     * - Есть предмет в базе
     *
     * @param ApiForm $model - поисковый запрос на получение предмета
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Throwable in case delete failed.
     * @return mixed
     */
    public function proccessSearchItem(ApiForm $model)
    {
        /** Проверка - если в БД у нас есть эта запись, тогда должны спарсить и обновить */
        if (ApiLoot::findItemsByName($model->item_name)) {

            /** Сперва удалим существующие записи */
            $this->removeItemsByQuery($model->item_name);

            /** Если нам удалось создать новые предметы, возвращаем их в контроллер */
            if ($this->createNewItems($model)) {

                /** Возвращаем в контроллер набор данных, который искали ранее */
                return ApiLoot::findItemsByName($model->item_name);
            }

            /** Возвращаем False в контроллер, если в API нет данных */
            return false;
        }

        /** Проверка - если в БД у нас нет похожих записей, тогда должны спарсить и создать */
        if (!ApiLoot::findItemsByName($model->item_name)) {

            /** Если нам удалось создать новые предметы, возвращаем их в контроллер */
            if ($this->createNewItems($model)) {

                /** Возвращаем в контроллер набор данных, который искали ранее */
                return ApiLoot::findItemsByName($model->item_name);
            }

            /** Возвращаем False в контроллер, если в API нет данных */
            return false;
        }

        /** Эксепшн на случай непредвиденных обстоятельств (Мы не должны сюда попадать, т.к. должны по идее остаться в одном из кейсов выше) */
        throw new HttpException(ResponseStatusInterface::SERVER_ERROR_CODE, 'Server error code');
    }

    /**
     * Метод обращается к API с поисковым запросом и либо создает новые AR объекты ApiLoot
     * либо возвращает false, если массив был пустой
     *
     * @param ApiForm $model - единичный объект ApiForm
     * @return mixed
     */
    private function getNewItems(ApiForm $model)
    {
        /** Задаем тело запроса в API - указывая сделать поиск по параметру полученному из формы */
        $this->setItemQuery($model->item_name);

        /** Задаем переменную с данными полученными по API о предметах */
        $item = $this->getApiData();

        /** Пуляем запрос и проверяем - если ничего, надо делать SetFlash */
        if (empty($item[Api::ATTR_DATA][Api::ATTR_ITEMS])) {

            /** Возвращаем уведомление, что не смогли найти искомый предмет */
            MessagesComponent::setMessages("<p class='alert alert-danger size-16 margin-top-20'><b>К сожалению мы не смогли ничего найти по вашему запросу, попробуйте другой запрос.</b></p>");

            /** Возвращаем false - если не смогли найти результат даже по APIшке */
            return false;
        }

        /** Возвращаем результат запроса если все хорошо */
        return $item;
    }

    /**
     * Метод создает новые записи о предметах в базе, если массив полученный от API не пустой
     * возвращает true в случае успеха сохранения или false, если массив API был пуст
     *
     * @param ApiForm $model - объект ApiForm
     * @return bool
     */
    private function createNewItems(ApiForm $model): bool
    {
        /** Переменная с запросом для получения данных по луту из API */
        $ApiItems = $this->getNewItems($model);

        /** Если предметы в API нашлись */
        if ($ApiItems !== false) {

            /** В цикле проходим весь массив из API и сохраняем в БД новые данные */
            foreach ($ApiItems[Api::ATTR_DATA][Api::ATTR_ITEMS] as $data) {

                /** Создаем новый объект AR класса ApiLoot */
                $newItem = new ApiLoot();

                /** Присваиваем необходимые атрибуты - в названии предмета удаляем пробелы по бокам */
                $newItem->name = trim($data[Api::ATTR_ITEM_NAME]);
                $newItem->url = $data[Api::ATTR_NORMALIZED_ITEM_NAME];
                $newItem->json = Json::encode($data);

                /** Сохраняем новые объекты */
                $newItem->save();
            }

            /** Возвращаем true если предметы сохранились */
            return true;
        }

        /** Возвращаем false - если предметы не сохранились */
        return false;
    }

    /**
     * Метод записывает в ApiSearchLogs данные о поисковых запросах пользователей через ApiForm
     *
     * @param ApiForm $model - объект модели ApiForm
     * @param int $flag - флаг, для проверки - вернулись ли данные по запросу или нет
     * @return bool
     */
    public function setSearchLog(ApiForm $model, int $flag = 0): bool
    {
        /** Создаем новый Ar объект логирующей запросы модели */
        $log = new ApiSearchLogs();

        /** Записываем в атрибут модели запрос, который осуществил пользователь */
        $log->words = $model->item_name;

        /** Записываем код рекапчи пользователя */
        $log->info = $model->recaptcha;

        /** Устанавливаем значение флага (0 - запрос не помог найти предметы, 1 - запрос помог найти предметы) */
        $log->flag = $flag;

        /** Пробуем сохранить и возвращаем bool результат */
        return $log->save();
    }

    /**
     * Метод проверяет не пуста ли таблица с квестами - возращает bool результат
     *
     * @return bool
     */
    private function isEmptyTasks(): bool
    {
        return empty(Tasks::find()->all()) ? true : false;
    }

    /**
     * Метод проверяет есть-ли в таблице квестов устаревшие записи - возращает bool результат
     *
     * @return bool
     */
    private function isOldTasks(): bool
    {
        /** Задаем SQL запрос переменной - ищем устаревшие записи */
        $tasks = Tasks::findAll([Tasks::ATTR_OLD => Tasks::TRUE]);

        /** Если найдены устаревшие боссы - возвращаем true, если нет false */
        if (!empty($tasks)) {

            /** Возвращаем true в случае, если в массиве есть боссы */
            return true;
        }

        /** Возвращаем false, если устаревшие боссы не были найдены */
        return false;
    }

    /**
     * Метод удаляет все квесты - возвращает bool результат
     *
     * @return bool
     * @throws StaleObjectException
     * @throws \Throwable
     */
    private function removeOldTasks(): bool
    {
        /** Задаем SQL запрос переменной - ищем устаревшие записи */
        $tasks = Tasks::find()->all();

        /** В цикле проходим всех устаревших боссов и удаляем их */
        foreach ($tasks as $task) {
            $task->delete();
        }

        /** Возвращаем true - если удаление боссов прошло успешно */
        return true;
    }

    /**
     * Метод проставляющий квестам дату устаревания - возвращает bool результат
     *
     * @return bool
     */
    private function setOldTasks(): bool
    {
        /** Задаем переменную с выборкой квестов, которые еще актуальны */
        $tasks = Tasks::findAll([Tasks::ATTR_OLD => Tasks::FALSE]);

        /** В цикле проходим все соответствующие записи */
        foreach ($tasks as $task) {

            /** Дата устаревания записи */
            $date = date('Y-m-d H:i:s', strtotime($task->date_create . ' +1 month'));

            /** Если дата записи +1 месяца - меньше текущего времени - запись должна быть помечена на удаление */
            if ($date < date("Y-m-d H:i:s",time())) {

                /** Устанавливаем флаг старой записи */
                $task->old = Tasks::TRUE;

                /** Сохраняем изменения */
                $task->save();
            }
        }

        /** Возвращаем true если все прошло успешно */
        return true;
    }

    /**
     * Сохраняем в базу данных все квесты, полученные из API
     *
     * @param array $data - массив с данными обо всех квестах из API
     * @return bool
     */
    private function createTasks(array $data): bool
    {
        /** В цикле проходим каждый квест из массив, полученного от API */
        foreach ($data[Api::ATTR_DATA][Api::ATTR_TASKS] as $task) {

            /** Задаем каждому объекту квеста атрибуты из массива */
            $model = new TaskModel($task);

            /** Сохраняем данные в БД (tasks) */
            if (!$model->save()) {

                /** Если данные не сохранились - вернем false */
                return false;
            }
        }

        /** Возвращаем bool результат если все ок */
        return true;
    }

    /**
     * Метод сетапит запрос для получения исторических цен на лут
     * Требуется ID предмета из GraphQL базы справочника tarkov.dev
     *
     * @param string $id - id предмета из API tarkov.dev
     * @return bool
     */
    private function setGraphsItemQuery(string $id): bool
    {
        /** Запрос для получения информацию по графику конкретного предмета (Последние сделки) */
        $this->query = $this->query->setGraphsItemQuery($id);

        /** Возвращаем bool результат */
        return true;
    }

    /**
     * @param string $id - id предмета из API tarkov.dev
     * @return string
     */
    public function getGraphsById(string $id): string
    {
        /** Сетапим запрос на получение графиков по конкретному луту */
        $this->setGraphsItemQuery($id);

        /** Получаем данные о графиках из API в виде JSON */
        return $this->getApiData(false);
    }

    /**
     * Метод удаляет через like все предметы лута из API, у которых название может совпадать с поисковым запросом
     *
     * @param string $query - Часть названия предмета (Поисковый запрос)
     * @return bool
     * @throws \Throwable in case delete failed.
     */
    private function removeItemsByQuery(string $query): bool
    {
        /** Находим весь лут, у которого в названии есть что-то похожее на наш запрос */
        $items = ApiLoot::find()->filterWhere(['like', ApiLoot::ATTR_NAME, $query])->all();

        /** В цикле проходим все предметы похожие на запрос поиска и удаляем их */
        foreach ($items as $item) {

            /** Удаляем данные о луте */
            $item->delete();
        }

        /** Возвращаем bool результат */
        return true;
    }

    /**
     * Метод для обновления данных о предмете из API справочника лута
     *
     * @param ApiLoot $item - AR объект, лут из API справочника
     * @return bool
     */
    public function renewItemData(ApiLoot $item): bool
    {
        /** Декодируя JSON предмета - получаем его id */
        $item_id = Json::decode($item->json)[Api::ATTR_ITEM_ID];

        /** Сетапим запрос API - для обновления данных о предмете */
        $this->query = $this->query->setSingleItemQuery($item_id);

        /** Сетапим данные из API - переменной */
        $content = $this->getApiData();

        /** Возвращаем bool результат обновления лута */
        return $item->updateData($content);
    }
}