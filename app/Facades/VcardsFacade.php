<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class VcardsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'vcards'; // This should match the name you used in the service provider
    }
}
