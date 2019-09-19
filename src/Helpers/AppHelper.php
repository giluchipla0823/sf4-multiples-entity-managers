<?php


namespace App\Helpers;


class AppHelper
{
    public static function getKernelContainer(){global $kernel;
        global $kernel;

        return $kernel->getContainer();
    }
}