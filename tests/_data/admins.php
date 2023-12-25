<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 25.12.2023
 * Time: 23:40
 *
 * 2 пользователя админки
 */
return [
    [
      'user' => 'test_admin',
      'password' => '4ac1b63dca561d274c6055ebf3ed97db', // test_pass
      'captcha' => 'test',
      'remember_me' => 0,
      'role' => 'admin',
      'date_end' => null,
      'name' => 'Username',
      'banned' => 0,
      'bann_reason' => null
    ],
    [
        'user' => 'old_user',
        'password' => 'bca377cd968e690ec2c586abb01c2326', // secondary_pass
        'captcha' => 'test',
        'remember_me' => 0,
        'role' => 'admin',
        'date_end' => null,
        'name' => 'SecondDude',
        'banned' => 1,
        'bann_reason' => 'Деактивация'
    ],
];