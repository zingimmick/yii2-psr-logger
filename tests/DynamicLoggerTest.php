<?php

declare(strict_types=1);

namespace Zing\YiiPsrLogger\Tests;

use yii\log\Logger as YiiLogger;
use Zing\YiiPsrLogger\DynamicLogger;

/**
 * @internal
 */
final class DynamicLoggerTest extends TestCase
{
    /**
     * @covers YiiLogger::log
     * @return void
     */
    public function testLoggerUsesCurrent(): void
    {
        $mock = $this->getMockBuilder(YiiLogger::class)->getMock();
        $mock->expects($this->once())
            ->method('log')
            ->with('test1 []', YiiLogger::LEVEL_INFO);

        $yiiLogger2 = $this->getMockBuilder(YiiLogger::class)->getMock();
        $yiiLogger2->expects($this->once())
            ->method('log')
            ->with('test2 []', YiiLogger::LEVEL_INFO);

        $dynamicLogger = new DynamicLogger();
        \Yii::setLogger($mock);

        $dynamicLogger->info('test1');

        \Yii::setLogger($yiiLogger2);
        $dynamicLogger->info('test2');
    }
}
