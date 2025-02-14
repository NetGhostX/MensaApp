<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    //aufagabe 3
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Get configured Monolog logger instance
     *
     * @param string $channel Channel name for the logger
     * @return Logger
     */
    protected function logger($channel = 'app')
    {
        $log = new Logger($channel);
        $log->pushHandler(new StreamHandler(storage_path('logs/emensa.log'), Level::Debug));
        return $log;
    }
}
