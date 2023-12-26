<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.11.2023
 * Time: 14:44
 */

namespace app\common\roles;

/**
 * Класс с ролями, которое использует приложение - в соответствии с этими ролями можно добавлять или убавлять возможности
 * Сделал так, потому что RBAC избыточен для моих задач здесь
 *
 * Class Roles
 * @package app\common\roles
 */
final class Roles
{
    /** @var string - Константа роли админа, есть доступ во все разделы, никаких ограничений */
    const ROLE_ADMIN = 'role_admin';

    /** @var string - Константа роли пользователя, оплатившего отписку от рекламы (В будущем возможно будем рекламу отключать) */
    const ROLE_SUBSCRIBER = 'role_subscriber';
}