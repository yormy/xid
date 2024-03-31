<?php

namespace Yormy\Xid\Observers\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class BaseEvent
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
    ) {
        // ...
    }
}
