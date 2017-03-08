<?php

namespace KeepMe\Cache;

use KeepMe\Cache\Contract\InvalidArgumentException as InvalidArgumentExceptionContract;

/**
 * Class InvalidArgumentException
 *
 * @package KeepMe\Cache
 */
class InvalidArgumentException extends \InvalidArgumentException implements InvalidArgumentExceptionContract
{
}