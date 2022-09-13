# Wiki Tarkov Project

## Описание
Проект Wiki Tarkov - это версия базы знаний по игре Escape From Tarkov. Разрабатывался с 10 октября 2017г., претерпел множество изменений на пути своего становления. В августе 2022г. был проведен глобальный рефакторинг проекта. В настоящий момент пример проекта можно увидеть на домене: https://wiki-tarkov.ru

Проект реализован на фреймворке Yii2, в качестве веб-сервера используется Nginx. База данных на MariaDb. Реализована концепция CI/CD и автодеплой с помощью в Production ветку bitbucket pipelines. В проекте также присутствует docker инструкция для развертывания в том числе на локальном устройстве.

Проект приносит прибыль с помощью показов рекламы, полученной от РСЯ (Рекламная сеть Яндекса)

Проект включает в себя следующие модули:

- Описания торговцев по игре Escape From Tarkov. Детальные таблицы торговцев с предметами, которые вы можете купить у них на 4-х уровнях репутации.
- Квесты, которые необходимо выполнять для торговцев для повышения репутации.
- Справочник лута, который включает в себя более 900 позиций с детальной 2-х уровневой категоризацией и привязкой позиций к квестам торговцев.
- Справочник ключей - база знаний с детальной информацией о видах ключей, для открывания различных помещений.
- Справочник умений - содержит в себе подробную информацию о доступных умениях, влияниях умений а также различных способах их прокачки.
- Новостной раздел - раздел новостей на сайте, с вебхуком для пуша новости в специальный раздел сервера Discord.
- Интерактивные карты локаций - карты локаций по игре, с огромным количеством различных маркеров с информацией по различным секретным местам.
- Список кланов - раздел, позволяющий зарегистрировать на сайте свой собственный клан с логотипом и ссылкой на сообщество. Также поддерживается возможность смотреть уже добавленные кланы (Только те, которые прошли модерацию).
- Раздел "Часто задаваемые вопросы" - содержит список всех часто задаваемых вопросов и ответы на них.
- Курсы валют - раздел для просмотра курсов валют евро, биткоина и доллара во внутриигровом мире, используется JS для мгновенного получения результата без перезагрузки страницы.
- Админка - написанная с нуля модульная Yii2 админка, которая необходима для администрирования сайта.
## Yii2 basic reworked 
В процессе разработки использовалась Yii2 basic, однако под нужды проекта она была доработана, в связи с чем в проекте появились некоторые нюансы.

> ``Важно:`` Была создана папка **common** в корне проекта (по аналогии с Yii2 Advanced шаблоном), куда были вынесены все необходимые изменения

В папке common структура папок следующая:
- controllers - контроллеры и трейты наследованные от базовых Yii'шных контроллеров
- services - сервисы, для реализации различной логики
- interfaces - папка с интерфейсами собственного производства
- helpers - собственные классы хелперов наследованные от базовых Yii'шных

Также в папке common присутствует env.php файл, который помогает инициализировать DotEnv и указывает, какие переменные проекта являются критичными.

> ``Важно:``  В директорию config/web был добавлен файл bootstrap.php, в котором прописана логика, которая должна стать доступна до инициализации приложения.

Вышеупомянутое стало возможно благодаря добавлению кода:

    require __DIR__ . '/config/bootstrap.php';

В файл yii.php до секций:

    $application = new yii\console\Application($config);
    $exitCode = $application->run();
Это позволяет запустить файл с предустановками до инициализации приложения, такой подход пригодился в том числе по той причине, что был изменен стандартный Url менеджер на более продвинутый, с собственными доработками.  