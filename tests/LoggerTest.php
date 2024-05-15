<?php

declare(strict_types=1);

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
     * @covers YiiLogger::log
     * @return void
     */
    public function testLogLevelMap(): void
    {
        $mock = $this->getMockBuilder(YiiLogger::class)->getMock();
        $mock->expects($this->once())
            ->method('log')
            ->with('test []', YiiLogger::LEVEL_ERROR);

        $logger = new Logger($mock);

        $logger->log(LogLevel::CRITICAL, 'test');
    }

    /**
     * @covers YiiLogger::log
     * @return void
     */
    public function testInvalidLogLevel(): void
    {
        $mock = $this->getMockBuilder(YiiLogger::class)->getMock();
        $logger = new Logger($mock);

        $this->expectException(\InvalidArgumentException::class);
        $logger->log('badlevel', 'test');
    }

    /**
     * @covers YiiLogger::log
     * @return void
     */
    public function testNonStringLogLevel(): void
    {
        $mock = $this->getMockBuilder(YiiLogger::class)->getMock();
        $logger = new Logger($mock);

        $this->expectException(\InvalidArgumentException::class);
        $logger->log(15, 'test');
    }
}
