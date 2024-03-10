<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 23.08.2022
 * Time: 9:10
 *
 * Фикстуры для квестов API (По примеру квестов барахольщика)
 */
return [
    [
        'quest' => 'Секрет успеха',
        'trader_name' => 'Барахольщик',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Секрет успеха","factionName":"Any","minPlayerLevel":26,"objectives":[{"type":"findQuestItem","description":"Найти Книгу о технологии изготовления одежды - Часть 1 на Развязке","optional":false},{"type":"giveQuestItem","description":"Передать первую книгу","optional":false},{"type":"findQuestItem","description":"Найти Книгу о технологии изготовления одежды - Часть 2 на Развязке","optional":false},{"type":"giveQuestItem","description":"Передать вторую книгу","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Шить - не тужить - Часть 2"},"status":["complete"]}],"experience":15600,"map":{"name":"Развязка"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":60000},{"item":{"name":"Балаклава Призрак","description":"Балаклава с рисунком черепа. Выглядит опасно.","iconLink":"https://assets.tarkov.dev/5ab8f4ff86f77431c60d91ba-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5ab8f4ff86f77431c60d91ba-image.webp"},"count":2}]}}',
        'url' => 'baraholshik-quests',
        'active' => 1,
        'old' => 0
    ],
    [
        'quest' => 'Борода не нужна',
        'trader_name' => 'Барахольщик',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Борода не нужна","factionName":"Any","minPlayerLevel":26,"objectives":[{"type":"traderLevel","description":"Достичь 3-го уровня лояльности с Терапевтом","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Секрет успеха"},"status":["complete"]}],"experience":15800,"map":null,"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":32000},{"item":{"name":"Бронешлем \"Алтын\"","description":"Шлемы \"Алтын\" прошли боевые испытания в Афганистане и Чечне и до сих пор находится на вооружении Министерства внутренних дел Российской Федерации и войсках специального назначения. Возможна установка бронированного забрала.","iconLink":"https://assets.tarkov.dev/5aa7e276e5b5b000171d0647-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5aa7e276e5b5b000171d0647-image.webp"},"count":1}]}}',
        'url' => 'eger-quests',
        'active' => 1,
        'old' => 0
    ],
    [
        'quest' => 'Борода не нужна',
        'trader_name' => 'Егерь',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Борода не нужна","factionName":"Any","minPlayerLevel":26,"objectives":[{"type":"traderLevel","description":"Достичь 3-го уровня лояльности с Терапевтом","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Секрет успеха"},"status":["complete"]}],"experience":15800,"map":null,"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":32000},{"item":{"name":"Бронешлем \"Алтын\"","description":"Шлемы \"Алтын\" прошли боевые испытания в Афганистане и Чечне и до сих пор находится на вооружении Министерства внутренних дел Российской Федерации и войсках специального назначения. Возможна установка бронированного забрала.","iconLink":"https://assets.tarkov.dev/5aa7e276e5b5b000171d0647-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5aa7e276e5b5b000171d0647-image.webp"},"count":1}]}}',
        'url' => 'eger-quests',
        'active' => 1,
        'old' => 0
    ],
    [
        'quest' => 'Меломан',
        'trader_name' => 'Барахолщик',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Меломан","factionName":"Any","minPlayerLevel":25,"objectives":[{"type":"visit","description":"Найти место встречи музыкантов на локации Улицы Таркова","optional":false},{"type":"findQuestItem","description":"Найти медиатор с гравировкой","optional":false},{"type":"giveQuestItem","description":"Передать медиатор","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Любитель балета"},"status":["complete"]},{"task":{"name":"Маршрутка"},"status":["complete"]}],"experience":17200,"map":{"name":"Улицы Таркова"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":87000},{"item":{"name":"Золотые часы Roler Submariner","description":"Золотые часы знаменитой марки Roler. Корпус из 18-ти каратного желтого золота.","iconLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-icon.webp","inspectImageLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-image.webp"},"count":1},{"item":{"name":"Золотое кольцо с черепом","description":"Кольцо в форме черепа, как настоящий атрибут пришедшего к успеху пацана.","iconLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-image.webp"},"count":1}]}}',
        'url' => 'baraholshik-quests',
        'active' => 1,
        'old' => 0
    ],
    [
        'quest' => 'Меломан',
        'trader_name' => 'Скупщик',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Меломан","factionName":"Any","minPlayerLevel":25,"objectives":[{"type":"visit","description":"Найти место встречи музыкантов на локации Улицы Таркова","optional":false},{"type":"findQuestItem","description":"Найти медиатор с гравировкой","optional":false},{"type":"giveQuestItem","description":"Передать медиатор","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Любитель балета"},"status":["complete"]},{"task":{"name":"Маршрутка"},"status":["complete"]}],"experience":17200,"map":{"name":"Улицы Таркова"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":87000},{"item":{"name":"Золотые часы Roler Submariner","description":"Золотые часы знаменитой марки Roler. Корпус из 18-ти каратного желтого золота.","iconLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-icon.webp","inspectImageLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-image.webp"},"count":1},{"item":{"name":"Золотое кольцо с черепом","description":"Кольцо в форме черепа, как настоящий атрибут пришедшего к успеху пацана.","iconLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-image.webp"},"count":1}]}}',
        'url' => 'skypshik-quests',
        'active' => 1,
        'old' => 0
    ],
    [
        'quest' => 'Меломан',
        'trader_name' => 'Прапор',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Меломан","factionName":"Any","minPlayerLevel":25,"objectives":[{"type":"visit","description":"Найти место встречи музыкантов на локации Улицы Таркова","optional":false},{"type":"findQuestItem","description":"Найти медиатор с гравировкой","optional":false},{"type":"giveQuestItem","description":"Передать медиатор","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Любитель балета"},"status":["complete"]},{"task":{"name":"Маршрутка"},"status":["complete"]}],"experience":17200,"map":{"name":"Улицы Таркова"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":87000},{"item":{"name":"Золотые часы Roler Submariner","description":"Золотые часы знаменитой марки Roler. Корпус из 18-ти каратного желтого золота.","iconLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-icon.webp","inspectImageLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-image.webp"},"count":1},{"item":{"name":"Золотое кольцо с черепом","description":"Кольцо в форме черепа, как настоящий атрибут пришедшего к успеху пацана.","iconLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-image.webp"},"count":1}]}}',
        'url' => 'prapor-quests',
        'active' => 1,
        'old' => 0
    ],
    [
        'quest' => 'Меломан',
        'trader_name' => 'Миротворец',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Меломан","factionName":"Any","minPlayerLevel":25,"objectives":[{"type":"visit","description":"Найти место встречи музыкантов на локации Улицы Таркова","optional":false},{"type":"findQuestItem","description":"Найти медиатор с гравировкой","optional":false},{"type":"giveQuestItem","description":"Передать медиатор","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Любитель балета"},"status":["complete"]},{"task":{"name":"Маршрутка"},"status":["complete"]}],"experience":17200,"map":{"name":"Улицы Таркова"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":87000},{"item":{"name":"Золотые часы Roler Submariner","description":"Золотые часы знаменитой марки Roler. Корпус из 18-ти каратного желтого золота.","iconLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-icon.webp","inspectImageLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-image.webp"},"count":1},{"item":{"name":"Золотое кольцо с черепом","description":"Кольцо в форме черепа, как настоящий атрибут пришедшего к успеху пацана.","iconLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-image.webp"},"count":1}]}}',
        'url' => 'mirotvorec-quests',
        'active' => 1,
        'old' => 0
    ],
    [
        'quest' => 'Меломан',
        'trader_name' => 'Лыжник',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Меломан","factionName":"Any","minPlayerLevel":25,"objectives":[{"type":"visit","description":"Найти место встречи музыкантов на локации Улицы Таркова","optional":false},{"type":"findQuestItem","description":"Найти медиатор с гравировкой","optional":false},{"type":"giveQuestItem","description":"Передать медиатор","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Любитель балета"},"status":["complete"]},{"task":{"name":"Маршрутка"},"status":["complete"]}],"experience":17200,"map":{"name":"Улицы Таркова"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":87000},{"item":{"name":"Золотые часы Roler Submariner","description":"Золотые часы знаменитой марки Roler. Корпус из 18-ти каратного желтого золота.","iconLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-icon.webp","inspectImageLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-image.webp"},"count":1},{"item":{"name":"Золотое кольцо с черепом","description":"Кольцо в форме черепа, как настоящий атрибут пришедшего к успеху пацана.","iconLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-image.webp"},"count":1}]}}',
        'url' => 'lyjnic-quests',
        'active' => 1,
        'old' => 0
    ],
    [
        'quest' => 'Меломан',
        'trader_name' => 'Терапевт',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Меломан","factionName":"Any","minPlayerLevel":25,"objectives":[{"type":"visit","description":"Найти место встречи музыкантов на локации Улицы Таркова","optional":false},{"type":"findQuestItem","description":"Найти медиатор с гравировкой","optional":false},{"type":"giveQuestItem","description":"Передать медиатор","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Любитель балета"},"status":["complete"]},{"task":{"name":"Маршрутка"},"status":["complete"]}],"experience":17200,"map":{"name":"Улицы Таркова"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":87000},{"item":{"name":"Золотые часы Roler Submariner","description":"Золотые часы знаменитой марки Roler. Корпус из 18-ти каратного желтого золота.","iconLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-icon.webp","inspectImageLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-image.webp"},"count":1},{"item":{"name":"Золотое кольцо с черепом","description":"Кольцо в форме черепа, как настоящий атрибут пришедшего к успеху пацана.","iconLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-image.webp"},"count":1}]}}',
        'url' => 'terapevt-quests',
        'active' => 1,
        'old' => 0
    ],
    [
        'quest' => 'Меломан',
        'trader_name' => 'Смотритель',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Меломан","factionName":"Any","minPlayerLevel":25,"objectives":[{"type":"visit","description":"Найти место встречи музыкантов на локации Улицы Таркова","optional":false},{"type":"findQuestItem","description":"Найти медиатор с гравировкой","optional":false},{"type":"giveQuestItem","description":"Передать медиатор","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Любитель балета"},"status":["complete"]},{"task":{"name":"Маршрутка"},"status":["complete"]}],"experience":17200,"map":{"name":"Улицы Таркова"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":87000},{"item":{"name":"Золотые часы Roler Submariner","description":"Золотые часы знаменитой марки Roler. Корпус из 18-ти каратного желтого золота.","iconLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-icon.webp","inspectImageLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-image.webp"},"count":1},{"item":{"name":"Золотое кольцо с черепом","description":"Кольцо в форме черепа, как настоящий атрибут пришедшего к успеху пацана.","iconLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-image.webp"},"count":1}]}}',
        'url' => 'seeker-quests',
        'active' => 1,
        'old' => 0
    ],
    [
        'quest' => 'Меломан',
        'trader_name' => 'Механик',
        'trader_icon' => 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp',
        'json' => '{"name":"Меломан","factionName":"Any","minPlayerLevel":25,"objectives":[{"type":"visit","description":"Найти место встречи музыкантов на локации Улицы Таркова","optional":false},{"type":"findQuestItem","description":"Найти медиатор с гравировкой","optional":false},{"type":"giveQuestItem","description":"Передать медиатор","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Любитель балета"},"status":["complete"]},{"task":{"name":"Маршрутка"},"status":["complete"]}],"experience":17200,"map":{"name":"Улицы Таркова"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":87000},{"item":{"name":"Золотые часы Roler Submariner","description":"Золотые часы знаменитой марки Roler. Корпус из 18-ти каратного желтого золота.","iconLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-icon.webp","inspectImageLink":"https://assets.tarkov.dev/59faf7ca86f7740dbe19f6c2-image.webp"},"count":1},{"item":{"name":"Золотое кольцо с черепом","description":"Кольцо в форме черепа, как настоящий атрибут пришедшего к успеху пацана.","iconLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5d235a5986f77443f6329bc6-image.webp"},"count":1}]}}',
        'url' => 'mehanic-quests',
        'active' => 1,
        'old' => 0
    ]
];