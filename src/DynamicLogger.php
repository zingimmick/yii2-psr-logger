<?php

declare(strict_types=1);

namespace Zing\YiiPsrLogger;

use Psr\Log\AbstractLogger;

class DynamicLogger extends AbstractLogger
{
    /**
     * @var \Zing\YiiPsrLogger\Logger|null
     */
    private $logger;

    /**
     * @var \yii\log\Logger|null
     */
    private $yiiLogger;

    /**
     * @var string
     */
    private $category;

    public function __construct(string $category = 'application')
    {
        $this->category = $category;
    }

    private function getLogger(): Logger
    {
        if (! ($this->logger !== null && $this->yiiLogger !== null) || \Yii::getLogger() !== $this->yiiLogger) {
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
