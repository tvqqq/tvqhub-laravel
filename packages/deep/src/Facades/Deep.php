<?php

namespace Deep\Facades;

use Deep\Controllers\DeepHelper;
use Illuminate\Support\Facades\Facade;

class Deep extends Facade
{
    public static function getFacadeAccessor()
    {
        return DeepHelper::class;
    }
}
