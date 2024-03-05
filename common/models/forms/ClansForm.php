<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 24.12.2023
 * Time: 21:49
 */

namespace app\common\models\forms;

use app\common\helpers\validators\UrlValidator;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\FileValidator;
use app\common\helpers\validators\ReCaptchaValidator;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\StringValidator;
use app\common\services\files\ImageService;
use app\models\Clans;
use yii\base\Model;
use Yii;

/**
 * Объект формы кланов, для регистрации новых кланов на сайте
 *
 * Class ClansForm
 * @package app\common\models\forms
 */
class ClansForm extends Model
{
    /** @var string - Название клана */
    public $title;
    const ATTR_TITLE = 'title';

    /** @var string - Описание клана */
    public $description;
    const ATTR_DESCRIPTION = 'description';

    /** @var string - Превьюшка клана */
    public $preview;
    const ATTR_PREVIEW = 'preview';

    /** @var string - Ссылка на страницу клана */
    public $link;
    const ATTR_LINK = 'link';

    /** @var string - Дата обновления записи */
    public $date_update;
    const ATTR_DATE_UPDATE = 'date_update';

    /** @var string $file - Переменная файла превьюшки */
    public $file;
    const FILE = 'file';

    /** @var string $reCaptcha - Переменная для рекапчи false */
    public $reCaptcha = false;
    const RECAPTCHA = 'reCaptcha';

    /**
     * Массив валидаций этой модели
     *
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [static::ATTR_TITLE, RequiredValidator::class],
            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => 100],

            [static::ATTR_DESCRIPTION, RequiredValidator::class],
            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            /** Валидация ссылки на клан или сообщество */
            [static::ATTR_LINK, RequiredValidator::class],
            [static::ATTR_LINK, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_LINK, UrlValidator::class],

            [static::ATTR_DATE_UPDATE, SafeValidator::class],

            [static::FILE, FileValidator::class, FileValidator::ATTR_EXTENSIONS => ['png','jpg']],

            [
                [static::RECAPTCHA],
                ReCaptchaValidator::class,
                ReCaptchaValidator::ATTR_SECRET => Yii::$app->params['recapchaKey'],
                ReCaptchaValidator::ATTR_UNCHECKED_MESSAGE => 'Подтвердите что вы не бот.'
            ]
        ];
    }

    /**
     * Переводы атрибутов
     *
     * @return array|string[]
     */
    public function attributeLabels(): array
    {
        return [
            static::ATTR_TITLE => 'Название клана',
            static::ATTR_DESCRIPTION => 'Краткое описание клана',
            static::ATTR_PREVIEW => 'Превью клана',
            static::FILE => 'Превью клана',
            static::ATTR_LINK => 'Ссылка на сообщество клана',
            static::RECAPTCHA => 'Защита от спама',
        ];
    }

    /**
     * Загрузка и сохранение превьюшки клана
     *
     * @return Model
     */
    public function uploadPreview(): Model
    {
        return ImageService::uploadFile($this, static::FILE);
    }

    /**
     * Метод сохранения нового клана в БД
     *
     * @return bool
     */
    public function save(): bool
    {
        /** Переменная для return'a */
        $result = false;

        /** Если текущая форма провалидировалась */
        if ($this->validate()) {

            /** Создаем новый AR объект кланов */
            $model = new Clans();

            /** Сетапим AR объекту название клана */
            $model->title = $this->title;

            /** Сетапим AR объекту описание клана */
            $model->description = $this->description;

            /** Сетапим AR объекту ссылка на сообщество клана */
            $model->link = $this->link;

            /** Сетапим AR объекту путь до загруженного файла */
            $model->preview = $this->preview;

            /** Сетапим AR объекту дату обновления записи */
            $model->date_update = $this->date_update;

            /** Сетапим переменной результат сохранения формы */
            $result = $model->save();
        }

        /** Возвращаем bool результат сохранения формы */
        return $result;
    }
}