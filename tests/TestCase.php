<?php

namespace Zing\YiiPsrLogger\Tests;

if (class_exists('PHPUnit_Framework_TestCase') && ! class_exists('PHPUnit\Framework\TestCase')) {
    class_alias('PHPUnit_Framework_TestCase', 'PHPUnit\Framework\TestCase');
}

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
}
