<?php

namespace Yormy\Xid\Observers\Events;

class XidInvalidEvent extends XidEvent
{
    private string $code = 'XID_INVALID';

    private string $severity = 'medium';
}
