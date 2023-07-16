<?php

namespace Yormy\Xid;

use Illuminate\Support\Facades\Facade;

class XidFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Xid::class;
    }
}
