<?php

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

    /**
     * @param string $category
     */
    public function __construct($category = 'application')
    {
        $this->category = $category;
    }

    /**
     * @return \Zing\YiiPsrLogger\Logger
     */
    private function getLogger()
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
     *
     * @phpstan-return void
     */
    public function log($level, $message, array $context = [])
    {
        $this->getLogger()
            ->log($level, $message, $context);
    }
}
