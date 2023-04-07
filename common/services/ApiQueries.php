<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.04.2023
 * Time: 8:20
 */

namespace app\common\services;

/**
 * Сервис, который задает запрос к API ресурса tarkov.dev
 *
 * Class ApiQueries
 * @package app\common\services
 */
class ApiQueries
{
    /** @var string - запрос, который будет отправляться в API */
    public $query;

    /** @var bool - Константа для возвратов положительных результатов по работе методов */
    const TRUE = true;

    /** @var bool - Константа для возвратов отрицательных результатов по работе методов */
    const FALSE = false;

    /**
     * Метод сетапит атрибуту класса запрос в API для получения информации о боссах,
     * которых можно встретить на локациях
     *
     * @return string
     */
    public function setBossesQuery(): string
    {
        /** Сетапим запрос по получению боссов атрибуту класса */
        $this->query = '{
               maps(lang: ru) {
                name
                bosses {
                  name
                  spawnChance
                  spawnTrigger
                  spawnLocations {
                    name
                  }
                  escorts {
                    amount {
                      count
                    }
                  }
                }
              }
            }';

        /** Возвращаем текущий запрос */
        return $this->query;
    }

    /**
     * Метод для получения множества позиций лута из API по параметру в виде строки (Название лута)
     * Сетапит запрос атрибуту текущего класса
     *
     * @param string $itemName - название лута, будет возвращено несколько позиций
     * @return string
     */
    public function setItemQuery(string $itemName): string
    {
        /** Сетапим запрос по получению данных по конкретному луту */
        $this->query = '{
          items(name: "'. $itemName . '", lang: ru, limit: 20) {
            id
            name
            normalizedName
            width
            height
            weight
            description
            category {
              name
            }
            iconLink
            inspectImageLink
            sellFor {
              vendor {
                name
              }
              price
              currency
              currencyItem {
                name
              }
              priceRUB
            }
            buyFor {
              vendor {
                name
              }
              price
              currency
              currencyItem {
                name
              }
              priceRUB
            }
            bartersFor {
              trader {
                name
              }
              level
              taskUnlock {
                name
              }
              requiredItems {
                item {
                  name
                  iconLink
                }
                count
                quantity
              }
            }
            receivedFromTasks {
                name
                trader {
                  name
                }
            }
            historicalPrices {
              price
              timestamp
            }
          } 
        }';

        /** Возвращаем запрос на получению информации по луту из API */
        return $this->query;
    }

    /**
     * Метод сетапит атрибуту класса запрос для API, который позволит получить
     * все квесты торговцев, которые на данный момент присутствуют в API
     *
     * @return string
     */
    public function setTasksQuery(): string
    {
        /** Сетапим запрос по получению квестов торговцев в API */
        $this->query = 'query {
          # Передаем сюда языковой код, чтобы все на RU было
          tasks (lang: ru) {
            # Название квеста
            name,
            # Для какой фракции квест (Bear или USEC или любая)
            factionName
            # Минимальный уровень игрока для получения квеста
            minPlayerLevel,
            # Задачи квеста, что нужно сделать
            objectives {
              # Тип квеста (Убийство, сдача предметов и т.д.)
              type,
              # Описание задания
              description,
              # Опциональность условия (false - обязательно, true - нет)
              optional
            }
            # Ключи, которые понадобятся для задачи
            neededKeys {
              # Массив с ключами
                    keys {
                name,
                iconLink
              }
            }
            # Требования к другим квестам перед выполнением текущего
            taskRequirements {
              # Название необходимого квеста
              task {
                name
              }
              # Требование к статусу квеста
              status
            }
            # Количество получаемого опыта - за выполнение квеста
            experience,
            # Название карты, на которой надо выполнить квест
            map {
              name
            }
            # Торговец, что выдал квест (Имя и изображение)
            trader {
              name,
              imageLink
            },
            # Можно ли перепроходить квест несколько раз
            restartable
            # Стартовые требования для квеста (Предметы)
            startRewards {
              # Предметы для выполнения квеста
              items {
                item {
                  name,
                  description,
                  iconLink,
                  inspectImageLink
                },
                # Количество стартовых предметов для квеста
                count
              }
            },
            # Награда за квест
            finishRewards {
              # Предметы выдаваемые в награду за выполнение квеста
              items {
                item {
                  name,
                  description,
                  iconLink,
                  inspectImageLink
                },
                # Количество стартовых предметов для квеста
                count
              }
            }
          }
        }';

        /** Возвращаем запрос по получению квестов торговцев */
        return $this->query;
    }


    /**
     * Метод сетапит атрибуту класса запрос для API, который позволит получить данные по ценам сделок,
     * которые происходили в прошлом по конкретному предмету (Возвращает больше 10-ти позиций)
     *
     * @param string $id - id лута из API
     * @return string
     */
    public function setGraphsItemQuery(string $id): string
    {
        /** Сетапим запрос по получению графиков изменения цен по параметру - ID лута из API */
        $this->query = 'query {
          historicalItemPrices(id: "'. $id .'") {
            price
            timestamp
          }
        }';

        /** Возвращаем запрос по получению графиков конкретного лута на страницах детального лута */
        return $this->query;
    }

}