<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 19.03.2024
 * Time: 14:12
 */

namespace app\tests;

use app\components\CookieComponent;
use Codeception\Test\Unit;

/**
 * Тестирование компонента кукисов
 *
 * Class CookieTest
 * @package app\tests\components
 */
class CookieTest extends Unit
{
    /**
     * Тест метода сетапа кукиса для скрытия рекламного блока
     *
     * @return void
     */
    public function testSetOverlay()
    {
        $result = CookieComponent::setOverlay();
        $this->assertTrue($result);
    }

    /**
     * Тест метода сетапа кукиса темной темы сайта
     *
     * @return void
     */
    public function testSetDarkTheme()
    {
        $result = CookieComponent::setDarkTheme();
        $this->assertTrue($result);
    }

    /**
     * Тест метода для установки Flash сообщения для приложения
     *
     * @return void
     */
    public function testSetMessages()
    {
        $messageText = "Example Error Message";
        $result = CookieComponent::setMessages($messageText);
        $this->assertTrue($result);
    }
}