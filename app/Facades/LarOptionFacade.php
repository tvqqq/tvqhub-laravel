<?php

namespace App\Facades;

use App\Repositories\LarOptionRepositoryInterface;
use Illuminate\Support\Facades\Facade as BaseFacade;

class LarOptionFacade extends BaseFacade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return LarOptionRepositoryInterface::class;
    }

}
