<?php

namespace Deep\Facades;

use Illuminate\Support\Facades\Facade;

class Deep extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'Deep';
    }
}
