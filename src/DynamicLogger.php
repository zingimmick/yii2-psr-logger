<?php

declare(strict_types=1);

namespace Zing\YiiPsrLogger;

use Psr\Log\AbstractLogger;
use yii\log\Logger as YiiLogger;

/**
 * Implements a PSR logger that routes messages to the current Yii Logger.
 */
class DynamicLogger extends AbstractLogger
{
    private ?Logger $logger = null;

    private ?YiiLogger $yiiLogger = null;

    public function __construct(
        private string $category = 'application'
    ) {
    }

    /**
     * Get current Yii Logger.
     */
    private function getLogger(): Logger
    {
        if (! ($this->logger instanceof Logger && $this->yiiLogger instanceof YiiLogger) || \Yii::getLogger() !== $this->yiiLogger) {
            $this->yiiLogger = \Yii::getLogger();
            $this->logger = new Logger(\Yii::getLogger(), $this->category);
        }

        return $this->logger;
    }

    /**
     * @param string $level
     * @param \Stringable|string $message
     * @param array<mixed> $context
     */
    public function log($level, $message, array $context = []): void
    {
        $this->getLogger()
            ->log($level, $message, $context);
    }
}
