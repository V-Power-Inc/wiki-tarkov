
<img alt="Repo logo" src="https://raw.githubusercontent.com/V-Power-Inc/wiki-tarkov/refs/heads/master/web/img/logo.png" align="right">

# Wiki Tarkov Project 💻

[![GitHub Actions](https://github.com/PC-Principal/wiki-tarkov/actions/workflows/DockerApp-Actions.yml/badge.svg)](https://github.com/PC-Principal/wiki-tarkov/actions/workflows/DockerApp-Actions.yml)
[![Deploy on Prod](https://github.com/V-Power-Inc/wiki-tarkov/actions/workflows/DeployProd.yml/badge.svg)](https://github.com/V-Power-Inc/wiki-tarkov/actions/workflows/DeployProd.yml)
![Site status](https://img.shields.io/badge/site%20status-disabled-red)
![Stable Version](https://img.shields.io/badge/version-v9.1.2-brightgreen)
![Stable branch](https://img.shields.io/badge/Stable%20branch-master-success)
![Tests Count](https://img.shields.io/badge/tests%20count-804-informational)
![Tests Code Coverage](https://img.shields.io/badge/coverage-89%25-success)
![Vulnerabilities Snyk Bitbucket](https://img.shields.io/badge/vulnerabilities-0-success)
![Discord Online](https://img.shields.io/discord/405924890328432652?label=Discord&logo=Discord&color=informational)


## Описание 💡
Проект Wiki Tarkov - это версия базы знаний по игре Escape From Tarkov. Разрабатывался с 10 октября 2017г., претерпел множество изменений на пути своего становления. В августе 2022г. был проведен глобальный рефакторинг проекта. В настоящий момент пример проекта можно увидеть на домене: https://wiki-tarkov.ru

Проект реализован на фреймворке Yii2, в качестве веб-сервера используется Nginx. База данных на MariaDb. Реализованы конвейеры CI/CD и автодеплой в master ветку GitHub или Bitbucket (По усмотрению, в текущей версии настроено на GitHub). В проекте также присутствует docker инструкция для развертывания в том числе на локальном устройстве.

Проект приносит прибыль с помощью показов рекламы, полученной от РСЯ (Рекламная сеть Яндекса) - произведена интеграция с AdFox.

Проект включает в себя следующие модули:

- Описания торговцев по игре Escape From Tarkov. Детальные таблицы торговцев с предметами, которые вы можете купить у них на 4-х уровнях репутации.
- API поставляет квесты, которые необходимо выполнять для торговцев для повышения репутации.
- Справочник лута, который включает в себя более 900 позиций с детальной 2-х уровневой категоризацией и привязкой позиций к квестам торговцев.
- Справочник ключей - база знаний с детальной информацией о видах ключей, для открывания различных помещений.
- Справочник умений - содержит в себе подробную информацию о доступных умениях, влияниях умений а также различных способах их прокачки.
- Новостной раздел - раздел новостей на сайте
- Интерактивные карты локаций - карты локаций по игре, с огромным количеством различных маркеров с информацией по различным секретным местам.
- Список кланов - раздел, позволяющий зарегистрировать на сайте свой собственный клан с логотипом и ссылкой на сообщество. Также поддерживается возможность смотреть уже добавленные кланы (Только те, которые прошли модерацию).
- Раздел "Часто задаваемые вопросы" - содержит список всех часто задаваемых вопросов и ответы на них.
- Курсы валют - раздел для просмотра курсов валют евро, биткоина и доллара во внутриигровом мире, используется JS для мгновенного получения результата без перезагрузки страницы.
- Админка - написанная с нуля модульная Yii2 админка, которая необходима для администрирования сайта.
- Возможность менять цветовую тему сайта, доступны 2 темы - светлая и темная, работает с помощью JS и кукиса
- API с сервиса tarkov.dev, которое позволяет получать актуальную информацию о боссах, которые могут спавниться на локациях а также всю информацию по покупке и бартеру лута у торговцев и на барахолке.
- API для получения дополнительной информации о луте (Стоимость, трейды, кто выдает и тому подобное)
- Логирование поисковых запросов пользователей к Api (Включая записи о рекапче)
- Сервис логирования ошибок в БД

## Yii2 basic reworked  ⭐
В процессе разработки использовалась Yii2 basic, однако под нужды проекта она была доработана, в связи с чем в проекте появились некоторые нюансы.

> ``Важно:`` Была создана папка **common** в корне проекта (по аналогии с Yii2 Advanced шаблоном), куда были вынесены все необходимые изменения

В папке common структура папок следующая:
- controllers - контроллеры и трейты наследованные от базовых Yii'шных контроллеров
- services - сервисы, для реализации различной логики
- interfaces - папка с интерфейсами собственного производства
- helpers - собственные классы хелперов наследованные от базовых Yii'шных
- models - модели для структурированных объектных данных и прослоек для Active Record моделей

Также в папке common присутствует env.php файл, который помогает инициализировать DotEnv и указывает, какие переменные проекта являются критичными.

> ``Важно:``  В директорию config/web был добавлен файл bootstrap.php, в котором прописана логика, которая должна стать доступна до инициализации приложения.

Вышеупомянутое стало возможно благодаря добавлению кода:

    require __DIR__ . '/config/bootstrap.php';

В файл yii.php до секций:

    $application = new yii\console\Application($config);
    $exitCode = $application->run();
Это позволяет запустить файл с предустановками до инициализации приложения, такой подход пригодился в том числе по той причине, что был изменен стандартный Url менеджер на более продвинутый, с собственными доработками.  

## Измененный Url менеджер 🔨

В этой версии приложения, мы изменили принцип работы Url менеджера, чтобы это стало возможно, были созданы следующие файлы:
 - common/controllers/AdvancedController - наследуется от базового Yii контроллера и использует трейт (Для клиентской части сайта)
 - common/controllers/AdminController - наследуется от базового Yii контроллера и использует трейт (Для админки)
 - common/controllers/ControllerRoutesTrait - трейт для вышеупомянутых контроллеров

Суть этого подхода в том, чтобы для бекенда и фронтенда использовались разные контроллеры, со своей логикой, но при этом чтобы у каждого из них была возможность использовать некий функционал, который сделал бы Url менеджер более прозрачным.

В трейте ControllerRoutesTrait содержатся 2 метода:

    public static function getUrlRoute(string $action, array $params = []): array
    public static function routeId(string $action): string

**getUrlRoute** при мередаче ему имени экшена, создает урлы вида controllerId/ActionId, также отлично работает и с модульными путями, его мы всегда будем вызывать при указании маршрутов в логике с использованием параметров (Возвращает массив).

**routeId** - этот метод делает тоже самое, что и верхний, но возвращает строку (Используется в большинстве случаев).

Т.к. показалось, что писать все маршруты приложения в config/web.php это избыточно, в директории config был создан новый файл routes.php
Пример того, как теперь может выглядеть config/web/routes.php:

    <?php  
    /** Отдельный файл routes - сюда для удобства были вынесены все маршруты */  
      
    use app\modules\admin\controllers\DefaultController;  
    use app\modules\admin\controllers\ModeratorController;  
      
    use app\controllers\SiteController;  
      
    return [  
      'admin/login' => DefaultController::routeId(DefaultController::ACTION_LOGIN),  
      'admin/logout' => DefaultController::routeId(DefaultController::ACTION_LOGOUT),
      'clans' => ClanController::routeId(ClanController::ACTION_INDEX),
      'loot' => LootController::routeId(LootController::ACTION_MAINLOOT),  
      
      '' => SiteController::routeId(SiteController::ACTION_INDEX),  
    ];

Такое возможно, благодаря наследованию всех новых контроллеров от AdvancedController или AdminController в зависимости от потребностей.

В константах классов пишется та часть, которая обычно в названии метода контроллера идет после слова action, например для метода:

    public function actionTest()
Константа в контроллере будет такой:

    const ACTION_TEST = 'test'

Если мы это делали скажем в ExampleController, то строка в файле route должна быть примерно такой:

    'testing-page' => ExampleController::routeId(ExampleController::ACTION_TEST)

Преимущество этого константного подхода в том, что если какой-либо url адрес поменяется нам не придется лазать по всему проекту, в бесконечных попытках произвести все замены (Кейс, когда отсутствует IDE).

## Миграции ✅
Для проекта были написаны все необходимые миграции, с комментариями на каждую таблицу и поля, добавлением индексов и внешних ключей, также были созданы триггеры для автообновления полей на некоторые таблицы.

Миграции могут быть применены с помощью команды в корневой директории проекта:

    docker-compose exec -T app php yii migrate

## Functional&Unit тестирование 🚦
В проекте реализовано функциональное и Unit тестирование с использованием Codeception. Всего написано 792 теста. В процессе тестирования использовались фикстуры для баз данных, как независимые, так и взаимосвязанные.
Unit тестирование было написано исключительно для таблиц баз данных. Функциональное для проверки работоспособности функционала как ожидается (Рендеринг страниц, определенные результаты на ней, реклама и кукисы).
Запуск тестов возможен стандартной командой в корневой директории проекта, если тесты не проходят в ситуации, когда должны - можно попробовать почистить кеш Redis:

    docker-compose exec -T redis redis-cli flushall  
    
    docker-compose exec -T app php vendor/bin/codecept run

Тестирование было разработано для следующего функционала:

 - Интерактивные карты
 - API по получению информации о квестах торговцев
 - Детальные страницы торговцев
 - Справочник лута
 - Категории справочника лута
 - Детальные страницы справочника лута
 - API по получению информации о боссах и актуальном луте
 - Таблица с информацией о патронах и их характеристики
 - Страница со списком кланов
 - Страница конвентера валют
 - Страница обратной связи
 - Страница новостей
 - Страница раздела полезных статей
 - Страница частые вопросы и ответы на них
 - Страницы админки, проверка прав доступа и прочее

## Snyk анализатор кода 😸

Т.к. проект отныне позиционируется как серьезный, была произведена интеграция Bitbucket и Github со Snyk анализатором кода. Это позволяет проверять каждый коммит на наличие возможных уязвимостей.

Snyk в настоящий момент применяет 2 теста для каждого коммита:

 - Licence - проверка, не нарушили ли мы лицензионные права используя что либо через compose
 - Security - ищет в нашем composer.lock файлы зависимости с известными уязвимостями

Таким образом, если мы загрузим нежелательный пакет через composer, мы узнаем это заблаговременно, т.к. тест Snyk не будет пройден, что сразу завершит конвейеры Snyk.

## GitGuardian 🚦

Чтобы не пропускать чувствительные данные в репозиторий, интеграция была осуществлена через внешний канал, в репозитории ничего не требуется делать. Можно подключить напрямую к репозиторию GitHub.

## Развертывание проекта через docker-compose up 🚀

Перед тем как локально развертывать проект, вам необходимо установить docker и docker-compose, на личном устройстве также можно использовать Docker Desktop.
Также на устройстве должен быть установлен Git.
Подробнее про Docker: https://www.docker.com/products/docker-desktop/
Подробнее про Git: https://git-scm.com/download

Дальнейшая инструкция подразумевает что у вас уже установлено необходимое ПО.

Первым делом клонируем репозиторий, например так:

    git clone https://github.com/V-Power-Inc/wiki-tarkov.git

Создаем в корне проекта файл .env и заполняем его например вот так (На скриншоте обязательные переменные):

    # Release version
    RELEASE=8.1.3

    # Environment
    ENVIRONMENT=dev
    
    # Boolean value of project status
    DEBUG_STATUS=false
    
    # Database
    # ---------------------
    DB_DSN=mysql:host=localhost;dbname=dev_db
    DB_NAME=dev_db
    DB_USER=usr_test
    DB_PASSWORD=TestPass
    DB_CHARSET=utf8
    
    # Database - unit, functional, other tests
    DB_TEST_DSN=mysql:host=localhost;dbname=for_test_db
    DB_TEST_NAME=for_test_db
    DB_TEST_USER=usr_test
    DB_TEST_PASSWORD=TestPass
    DB_TEST_CHARSET=utf8
    
    # Redis Host
    REDIS_HOST='localhost'
    
    # Domain Credentials
    DOMAIN_PROTOCOL=http://
    DOMAIN=localhost

    # Recapcha things (Здесь тестовая капча, работает и на локалхосте)
    RECAPCHAKEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
    RECAPCHASITEKEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
    
    # DSN for log
    SENTRY_DSN=https://log-url.ru

    # Problem item urls that should be excepted - API (trim value whitespaces)
    PROBLEM_URLS=test1,test2,test

    # Problem item names that should be excepted - API (trim value whitespaces)
    PROBLEM_NAMES=test1,test2,test
    
Домен и протокол можно указать и свои, это для продакшена. Мы все равно будем на localhost, когда проект будет развернут через Docker.

Теперь переходим в корень проекта и запускам следующую команду (Docker должен быть запущен к этому моменту):

    docker-compose up -d --build
У нас начнется продолжительный процесс инициализации докер контейнеров, после того как все будет готово у нас будут контейнеры со следующими именами:
 - tarkov_app - отсюда запускаем yii и php команды
 - tarkov_db - здесь можем залогиниться и выполнять команды от пользователя MariaDB
 - tarkov_redis - сюда заходить для команд с RedisCache
 - tarkov_web - здесь работает веб-сервер Nginx

>  Важно помнить что докер в процессе работы создает свою рабочую сеть, поэтому **здесь можно забыть про обращения к сервисам по localhost**. Как localhost в браузере доступен только наш сайт, потому что в конфиге docker-compose.yml ему был проброшен 80 порт, для работы с другими службами нужно обращаться к ним только через терминал по имени службы.

Как только докер закончит скачку необходимых образов и будет готов к работе, выполняем команды:

- docker-compose exec -T app composer install --no-interaction

(Эта команда даст достаточно прав пользователю для создания триггеров)
- docker exec -t tarkov_db mysql -u root -pTestPass --execute "use dev_db;
              CREATE DATABASE for_test_db;
              GRANT SUPER ON *.* TO 'usr_test'@'%' WITH GRANT OPTION;
              GRANT ALL PRIVILEGES ON dev_db.* TO 'usr_test'@'%' WITH GRANT OPTION;
              GRANT ALL PRIVILEGES ON for_test_db.* TO 'usr_test'@'%' WITH GRANT OPTION;"

- docker-compose exec -T app php yii migrate --interactive=0

- docker-compose exec -T app php yii migrate --db db_test --interactive=0

Таким образом мы применим миграции внутри докер контейнера и полностью развернем проект, дав db пользователю права для работы с 2 базами данных (Основной и тестовой).

Все остальные команды можно запускать аналогично вышеупомянутому примеру.

В конце нужно создать папки для изображений (Они из админки через CRUD грузятся):

- web/img/upload
- web/img/admin

Если что-то не получается, пример шагов, которые происходят при развертке проекта можно глянуть в .github/workflows/Repo-Actions.yml - по сути ваши шаги должны быть аналогичными этому файлу.

## Раздел администратора 🚦

Доступен по адресу /admin - там нужно авторизоваться как администратор сайта, для этого нужно предварительно заполнить пользователя в таблицу admins, (Пароль - хеш sha1). Далее после авторизации будет доступен интерфейс администратора.

## Заключение ✅

В рамках работы над этим проектом были сильно повышены навыки, применение миграций, создание CI/CD, а также комментарии делают этот репозиторий неплохим учебным развитием для любителей обучаться новым технологиям.

Конечно в проекте не все идеально, но т.к. это pet-project - здесь для любой ситуации возможны исключения, так или иначе проект регулярно дорабатывается по мере необходимости.

## Стратегия Pull Requests ✅

Если вы хотите добавить в репозиторий новые коммиты, создайте новую ветку наследуясь от ветки **dev**, укажите в названии ветки префикс **contribute_название вашей ветки**, после проделанных работ отправьте свою ветку в этот репозиторий.

После модерации изменения будут внесены в **dev** (далее во время релиза в master) ветку, либо будут даны комментарии по поводу проделанных работ.

## Стек ✅
<div>
  <img src="https://github.com/devicons/devicon/blob/master/icons/docker/docker-original.svg" title="Docker" alt="Docker" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/php/php-original.svg" title="Php" alt="Php" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/yii/yii-original.svg" title="Yii 2"  alt="Yii 2" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/mysql/mysql-original-wordmark.svg" title="MySQL"  alt="MySQL" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/css3/css3-plain-wordmark.svg"  title="CSS3" alt="CSS" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/html5/html5-original.svg" title="HTML5" alt="HTML" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/javascript/javascript-original.svg" title="JavaScript" alt="JavaScript" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/nginx/nginx-original.svg" title="Nginx" alt="Nginx" width="40" height="40"/>&nbsp;
</div>

## Ссылка на API используемый в проекте 📚

- https://tarkov.dev/api/ (Tarkov DEV Api)

## Ссылки на репозитории проекта 📚

- https://github.com/PC-Principal/wiki-tarkov (Основная разработка)
- https://bitbucket.org/PC_Principal/eft-locations-map (Закрытая резервная репа)

## Авторы 🧑‍🤝‍🧑

Thank you to all of our awesome contributors! ❤️

<a href="https://github.com/V-Power-Inc/wiki-tarkov/graphs/contributors">
  <img alt="Contributors" src="https://contrib.rocks/image?repo=V-Power-Inc/wiki-tarkov" />
</a>

Made with [contrib.rocks](https://contrib.rocks).