<?php

namespace Yormy\Xid\Models\Traits;

use Yormy\Xid\Services\XidService;

trait XidCreationTrait
{
    public static function bootXid()
    {
        static::creating(function ($model) {
            if (! property_exists($model, 'xid')) {
                if (! $model->xid) {
                    $model->xid = XidService::generate();
                }
            }
        });
    }
}
