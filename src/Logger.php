<?php

namespace Zing\YiiPsrLogger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use yii\helpers\Json;

class Logger extends AbstractLogger
{
    /**
     * @var \yii\log\Logger
     */
    private $logger;

    /**
     * @var string
     */
    private $category;

    /**
     * @var array<string, int>
     */
    private $formatLevelMap = [
        LogLevel::EMERGENCY => \yii\log\Logger::LEVEL_ERROR,
        LogLevel::ALERT => \yii\log\Logger::LEVEL_ERROR,
        LogLevel::CRITICAL => \yii\log\Logger::LEVEL_ERROR,
        LogLevel::ERROR => \yii\log\Logger::LEVEL_ERROR,
        LogLevel::WARNING => \yii\log\Logger::LEVEL_WARNING,
        LogLevel::NOTICE => \yii\log\Logger::LEVEL_WARNING,
        LogLevel::INFO => \yii\log\Logger::LEVEL_INFO,
        LogLevel::DEBUG => \yii\log\Logger::LEVEL_INFO,
    ];

    /**
     * @param string $category
     */
    public function __construct(\yii\log\Logger $logger = null, $category = 'application')
    {
        $this->logger = isset($logger) ? $logger : \Yii::getLogger();
        $this->category = $category;
    }

    /**
     * @param mixed $level
     * @param mixed $message
     * @param array<mixed> $context
     *
     * @phpstan-return void
     */
    public function log($level, $message, array $context = [])
    {
        if (! \is_string($level)) {
            throw new \InvalidArgumentException('This logger only supports string levels');
        }

        if (! isset($this->formatLevelMap[$level])) {
            throw new \InvalidArgumentException(\sprintf('Unknown logging level %s', $level));
        }

        $this->logger->log(
            $message . ' ' . Json::encode($context),
            $this->formatLevelMap[$level],
            $this->category
        );
    }
}
