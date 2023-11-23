<?php

namespace Vkrsmart\Sdk;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class Log
{
    public static function debug(string $message)
    {
        $log = new Logger('my_logger');
        $log->pushHandler(new StreamHandler(__DIR__ . '/app.log', Level::Debug));
        $log->debug($message);
    }
}