<?php

namespace App\Facades;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Facade as BaseFacade;

class HelperFacade extends BaseFacade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Helper::class;
    }

}
