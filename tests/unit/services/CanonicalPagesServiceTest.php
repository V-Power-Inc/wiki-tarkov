<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 24.03.2024
 * Time: 11:38
 */

namespace app\tests;

use app\common\services\CanonicalPagesService;
use yii\base\InvalidConfigException;
use yii\web\Response;
use Yii;
use Codeception\Test\Unit;
use UnitTester;

/**
 * Тестируем сервис по редиректам на канонические страницы
 *
 * Class CanonicalPagesServiceTest
 * @package app\tests
 */
class CanonicalPagesServiceTest extends Unit
{
    /** @var UnitTester - Объект класса для тестирования */
    protected UnitTester $tester;

    /**
     * Тестируем метод переадресации, если запришиваемый и канонический URL не равны
     *
     * @return void
     * @throws InvalidConfigException
     */
    public function testRedirectToCanonical()
    {
        /** Переменная с каноническим урлом */
        $canonicalUrl = '/canonical/url';

        /** Переменная с запрашиваемым урлом */
        $requestedUrl = '/requested/url';

        /** Мокаем Yii::$app->request->hostInfo */
        Yii::$app->request->hostInfo = 'http://example.com';

        /** Создаем мок для Response */
        $responseMock = $this->getMockBuilder(Response::class)
            ->setMethods(['redirect'])
            ->getMock();

        /** Ожидаем вызов метода redirect с каноническим URL и кодом 301 */
        $responseMock->expects($this->once())
            ->method('redirect')
            ->with($canonicalUrl, 301)
            ->willReturn(new Response());

        /** Сетапим мок для Response */
        Yii::$app->set('response', $responseMock);

        /** Дергаем метод с параметрами */
        $result = CanonicalPagesService::redirectToCanonical($canonicalUrl, $requestedUrl);

        /** Проверяем, что результатом является объект Response */
        $this->assertInstanceOf(Response::class, $result);
    }

    /**
     * Тестируем метод переадресации, если запришиваемый и канонический URL равны
     *
     * @return void
     */
    public function testRequestedUrlIsCanonical()
    {
        /** Переменная с каноническим урлом */
        $canonicalUrl = '/canonical/url';

        /** Переменная с запрашиваемым урлом */
        $requestedUrl = '/canonical/url';

        /** Дергаем метод */
        $result = CanonicalPagesService::redirectToCanonical($canonicalUrl, $requestedUrl);

        /** Проверяем, что результатом является false */
        $this->assertFalse($result);
    }
}