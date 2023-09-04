<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\PHPUnit\CodeQuality\Rector\Class_\AddSeeTestAnnotationRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\LevelSetList;
use Zing\CodingStandard\Set\RectorSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([LevelSetList::UP_TO_PHP_73, PHPUnitSetList::PHPUNIT_CODE_QUALITY, RectorSetList::CUSTOM]);
    $rectorConfig->phpstanConfig(__DIR__ . '/phpstan.neon');
    $rectorConfig->parallel();
    $rectorConfig->skip([AddSeeTestAnnotationRector::class]);
    $rectorConfig->paths([__DIR__ . '/src', __DIR__ . '/tests', __DIR__ . '/ecs.php', __DIR__ . '/rector.php']);
};
