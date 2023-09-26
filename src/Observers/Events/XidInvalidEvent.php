<?php

namespace Yormy\Xid\Observers\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Yormy\Xid\Observers\Events\BaseEvent;

class XidInvalidEvent extends BaseEvent
{
    public function __construct(
        private string $xid,
    )
    {
        // ...
        parent::__construct();
    }

    public function getXid(): string
    {
        return $this->xid;
    }
}
