<?php

namespace Zing\YiiPsrLogger\Tests;

use Psr\Log\LogLevel;
use yii\log\Logger as YiiLogger;
use Zing\YiiPsrLogger\Logger;

/**
 * @internal
 */
final class LoggerTest extends TestCase
{
    /**
     * @phpstan-return void
     */
    public function testLogLevelMap()
    {
        $mockObject = $this->getMockBuilder('yii\log\Logger')
            ->getMock();
        $mockObject->expects($this->once())
            ->method('log')
            ->with('test []', YiiLogger::LEVEL_ERROR);

        $logger = new Logger($mockObject);

        $logger->log(LogLevel::CRITICAL, 'test');
    }

    /**
     * @phpstan-return void
     */
    public function testInvalidLogLevel()
    {
        $mockObject = $this->getMockBuilder('yii\log\Logger')
            ->getMock();
        $logger = new Logger($mockObject);

        if (method_exists($this, 'expectException')) {
            $this->expectException('InvalidArgumentException');
        } else {
            $this->setExpectedException('InvalidArgumentException');
        }

        $logger->log('badlevel', 'test');
    }

    /**
     * @phpstan-return void
     */
    public function testNonStringLogLevel()
    {
        $mockObject = $this->getMockBuilder('yii\log\Logger')
            ->getMock();
        $logger = new Logger($mockObject);

        if (method_exists($this, 'expectException')) {
            $this->expectException('InvalidArgumentException');
        } else {
            $this->setExpectedException('InvalidArgumentException');
        }

        $logger->log(15, 'test');
    }
}
