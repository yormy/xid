<?php

namespace Yormy\Xid\Observers\Events;

class XidInvalidEvent extends BaseEvent
{
    public function __construct(
        private string $xid,
    ) {
        // ...
        parent::__construct();
    }

    public function getXid(): string
    {
        return $this->xid;
    }

    public function getData(): string
    {
        return $this->xid;
    }
}
