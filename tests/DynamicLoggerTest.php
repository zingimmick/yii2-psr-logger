<?php

namespace Zing\YiiPsrLogger\Tests;

use yii\log\Logger as YiiLogger;
use Zing\YiiPsrLogger\DynamicLogger;

/**
 * @internal
 */
final class DynamicLoggerTest extends TestCase
{
    /**
     * @phpstan-return void
     */
    public function testLoggerUsesCurrent()
    {
        $mockObject = $this->getMockBuilder('yii\log\Logger')
            ->getMock();
        $mockObject->expects($this->once())
            ->method('log')
            ->with('test1 []', YiiLogger::LEVEL_INFO);

        $mockObject2 = $this->getMockBuilder('yii\log\Logger')
            ->getMock();
        $mockObject2->expects($this->once())
            ->method('log')
            ->with('test2 []', YiiLogger::LEVEL_INFO);

        $dynamicLogger = new DynamicLogger();
        \Yii::setLogger($mockObject);

        $dynamicLogger->info('test1');

        \Yii::setLogger($mockObject2);
        $dynamicLogger->info('test2');
    }
}
