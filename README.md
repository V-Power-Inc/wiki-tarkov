
<img src="https://wiki-tarkov.ru/img/upload/icon-128-128.png" align="right">

Wiki Tarkov Project 💻
=================

[![GitHub Actions](https://github.com/PC-Principal/wiki-tarkov/actions/workflows/DockerApp-Actions.yml/badge.svg)](https://github.com/PC-Principal/wiki-tarkov/actions/workflows/DockerApp-Actions.yml)
[![Deploy on Prod](https://github.com/PC-Principal/wiki-tarkov/actions/workflows/DeployProd.yml/badge.svg?branch=master)](https://github.com/PC-Principal/wiki-tarkov/actions/workflows/DeployProd.yml)
![Site status](https://img.shields.io/badge/site%20status-works-success)
![Stable Version](https://img.shields.io/badge/version-v5.5.31-brightgreen)
![Stable branch](https://img.shields.io/badge/Stable%20branch-master-success)
![Tests Count](https://img.shields.io/badge/tests%20count-976-informational)
![Tests Code Coverage](https://img.shields.io/badge/coverage-85%25-yellowgreen)
![Vulnerabilities Snyk Bitbucket](https://img.shields.io/badge/vulnerabilities-0-success)
![Discord Online](https://img.shields.io/discord/405924890328432652?label=Discord&logo=Discord&color=informational)


## Описание 💡
Проект Wiki Tarkov - это версия базы знаний по игре Escape From Tarkov. Разрабатывался с 10 октября 2017г., претерпел множество изменений на пути своего становления. В августе 2022г. был проведен глобальный рефакторинг проекта. В настоящий момент пример проекта можно увидеть на домене: https://wiki-tarkov.ru

Проект реализован на фреймворке Yii2, в качестве веб-сервера используется Nginx. База данных на MariaDb. Реализована концепция CI/CD и автодеплой в Production ветку bitbucket pipelines или GitHub (По усмотрению). В проекте также присутствует docker инструкция для развертывания в том числе на локальном устройстве.

Проект приносит прибыль с помощью показов рекламы, полученной от РСЯ (Рекламная сеть Яндекса) - произведена интеграция с рекламным агрегатором AdFox

Проект включает в себя следующие модули:

- Описания торговцев по игре Escape From Tarkov. Детальные таблицы торговцев с предметами, которые вы можете купить у них на 4-х уровнях репутации.
- API поставляет квесты, которые необходимо выполнять для торговцев для повышения репутации.
- Справочник лута, который включает в себя более 900 позиций с детальной 2-х уровневой категоризацией и привязкой позиций к квестам торговцев.
- Справочник ключей - база знаний с детальной информацией о видах ключей, для открывания различных помещений.
- Справочник умений - содержит в себе подробную информацию о доступных умениях, влияниях умений а также различных способах их прокачки.
- Новостной раздел - раздел новостей на сайте, с вебхуком для пуша новости в специальный раздел сервера Discord.
- Интерактивные карты локаций - карты локаций по игре, с огромным количеством различных маркеров с информацией по различным секретным местам.
- Список кланов - раздел, позволяющий зарегистрировать на сайте свой собственный клан с логотипом и ссылкой на сообщество. Также поддерживается возможность смотреть уже добавленные кланы (Только те, которые прошли модерацию).
- Раздел "Часто задаваемые вопросы" - содержит список всех часто задаваемых вопросов и ответы на них.
- Курсы валют - раздел для просмотра курсов валют евро, биткоина и доллара во внутриигровом мире, используется JS для мгновенного получения результата без перезагрузки страницы.
- Админка - написанная с нуля модульная Yii2 админка, которая необходима для администрирования сайта.
- Возможность менять цветовую тему сайта, доступны 2 темы - светлая и темная, работает с помощью JS и кукиса
- API с сервиса tarkov.dev, которое позволяет получать актуальную информацию о боссах, которые могут спавниться на локациях а также всю информацию по покупке и бартеру лута у торговцев и на барахолке.
- API для получения дополнительной информации о луте (Стоимость, трейды, кто выдает и тому подобное)
- Логирование поисковых запросов пользователей к Api (Включая записи о рекапче)
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
      'admin/ass-destroyer' => ModeratorController::routeId(ModeratorController::ACTION_INDEX),  
      
      '' => SiteController::routeId(SiteController::ACTION_INDEX),  
    ];

Такое возможно, благодаря наследованию всех новых контроллеров от AdvancedController или AdminController в зависимости от потребностей.

В константах классов пишется та часть, которая обычно в названии метода контроллера идет после слова action, например для метода:

    public function actionTest()
Константа в контроллере будет такой:

    const ACTION_TEST = 'test'

Если мы это делали скажем в ExampleController, то строка в файле route должна быть примерно такой:

    'testing-page' => ExampleController::routeId(ExampleController::ACTION_TEST)

Преимущество этого константного подхода в том, что если какой-либо url адрес поменяется нам не придется лазать по всему проекту, в бесконечных попытках произвести все замены (Учитывать кейс отсутствия PhpStorm в том числе).
## Миграции ✅
Для проекта были написаны все необходимые миграции, с комментариями на каждую таблицу и каждое поле, добавлением индексов и внешних ключей, также были созданы триггеры для автообновления полей на некоторые таблицы.

Всего в проекте 53 миграции для базы данных. Миграции могут быть применены с помощью команды в корневой директории проекта:

    php yii migrate


## Functional&Unit тестирование 🚦
В проекте реализовано функциональное и Unit тестирование с использованием Codeception. Всего написано 196 методов тестирования с 925 ожиданиями определенных результатов. В процессе тестирования использовались фикстуры для баз данных, как независимые, так и взаимосвязанные.
Unit тестирование было написано исключительно для таблиц баз данных. Функциональное для проверки работоспособности функционала как ожидается (Рендеринг страниц, определенные результаты на ней, реклама и кукисы).
Запуск Unit тестов возможен стандартной командой в корневой директории проекта, однако - чтобы не было проблем рекомендуется такая последовательность, на выходе все тесты пройдут (08_03_2023):

    redis-cli flushall  
 
    vendor/bin/codecept run tests/functional/ItemsCest  

    vendor/bin/codecept run unit
    
    vendor/bin/codecept run
![enter image description here](https://wiki-tarkov.ru/img/admin/testing.gif)

Тестирование было разработано для следующего функционала:

 - Интерактивные карты
 - API по получению информации о квестах торговцев
 - Детальные страницы торговцев
 - Справочник лута
 - Категории справочника лута
 - Детальные страницы справочника лута
 - API по получению информации о боссах и актуальном луте
 - Страница со списком кланов

Вышеупомянутый функционал составляет примерно 90% проекта.
## Snyk анализатор кода 😸
Т.к. проект отныне позиционируется как серьезный, была произведена интеграция Bitbucket и Github со Snyk анализатором кода. Это позволяет проверять каждый коммит на наличие возможных уязвимостей.

Snyk в настоящий момент применяет 2 теста для каждого коммита:

 - Licence - проверка, не нарушили ли мы лицензионные права используя что либо через compose
 - Security - ищет в нашем composer.lock файлы зависимости с известными уязвимостями

Таким образом, если мы загрузим нежелательный пакет через composer, мы узнаем это заблаговременно, т.к. тест Snyk не будет пройден, что сразу завершит конвейеры Snyk.

## Развертывание проекта через docker-compose up 🚀

Перед тем как локально развертывать проект, вам необходимо установить docker и docker-compose, в качестве альтернативы на личном устройстве можно использовать DockerDesktop.
Также на устройстве должен быть установлен Git.
Подробнее про Docker: https://www.docker.com/products/docker-desktop/
Подробнее про Git: https://git-scm.com/download

Дальнейшая инструкция подразумевает что у вас уже установлено необходимое ПО.

Первым делом клонируем репозиторий, например так:

    git clone https://PC_Principal@bitbucket.org/PC_Principal/eft-locations-map.git

Создаем в корне проекта файл .env и заполняем его например вот так (Можно и своими данными, слева обязательные переменные):

    # Environment  
    ENVIRONMENT=dev  
      
    # Debug status  
    DEBUG_STATUS=true  
      
    # Database  
    # ---------------------  
    DB_DSN=mysql:host=db;dbname=dev_db 
    DB_NAME=dev_db 
    DB_USER=usr_test  
    DB_PASSWORD=passworDed
    DB_CHARSET=utf8  
      
    # Database - unit tests  
    DB_TEST_DSN=mysql:host=db;dbname=for_test_db  
    DB_TEST_NAME=for_test_db    
    DB_TEST_USER=usr_test  
    DB_TEST_PASSWORD=passworDed 
    DB_TEST_CHARSET=utf8  
      
    # Redis Host  
    REDIS_HOST='redis'  
      
    # Domain Credentials  
    DOMAIN_PROTOCOL=https://  
    DOMAIN=wiki-tarkov.ru
Домен и протокол можно указать и свои, это для продакшена. Мы все равно будем на localhost.

Теперь переходим в корень проекта и запускам следующую команду (Docker должен быть уже запущен):

    docker-compose up
У нас начнется продолжительный процесс инициализации докер контейнеров, после того как все будет готово у нас будут контейнеры со следующими именами:
 - app - отсюда запускаем yii и php команды
 - db - здесь можем залогиниться и выполнять команды от пользователя MariaDB
 - redis - сюда заходить для команд с RedisCache
 - web - здесь работает веб-сервер Nginx, обычно сюда не надо

>  Важно помнить что докер в процессе работы создает свою рабочую сеть, поэтому **здесь можно забыть про обращения к сервисам по localhost**. Как localhost в браузере доступен только наш сайт, потому что в конфиге docker-compose.yml ему был проброшен 80 порт, для работы с другими службами нужно обращаться к ним только через терминал по имени службы.

Как только докер закончит скачку необходимых образов и будет готов к работе, выполняем команду:

- docker-compose exec -T app php yii migrate

Таким образом мы применим миграции к dev_db внутри докер контейнера. Если есть необходимость создать дополнительную базу для тестов, ее нужно называть в соответствии с DB_TEST_NAME из .env файла.

Все остальные команды можно запускать аналогично вышеупомянутому примеру.
## Заключение

В рамках работы над этим проектом были сильно повышены навыки, применение миграций, создание CI/CD концепции развития продукта, а также строгие комментарии и следование PSR стандартам делают этот репозиторий неплохим учебным развитием для любителей обучаться новым и продвинутым технологиям.

Конечно в проекте не все идеально, но т.к. это pet-project - здесь для любой ситуации возможны исключения, так или иначе проект регулярно дорабатывается по мере необходимости.

## Ссылка на API используемый в проекте 📚

- https://tarkov.dev/api/ (Tarkov DEV Api)

## Ссылки на репозитории проекта 📚

- https://bitbucket.org/PC_Principal/eft-locations-map (08.03.2023г. - Недоступен без VPN)
- https://github.com/PC-Principal/wiki-tarkov (Основная разработка)