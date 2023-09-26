<?php

namespace Yormy\Xid\Observers\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Mexion\BedrockUsersv2\Domain\User\Models\Member;

abstract class BaseEvent
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
    ) {
        // ...
    }

}
