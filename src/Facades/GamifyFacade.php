<?php

namespace Sajidbashir24h\Gamify\Facades;

use Illuminate\Support\Facades\Facade;

class GamifyFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'gamify';
    }
}
