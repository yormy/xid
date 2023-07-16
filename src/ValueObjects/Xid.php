<?php

namespace Yormy\Xid\ValueObjects;

use Yormy\Xid\Services\XidService;

class Xid
{
    protected ?string $xid = null;

    public function __construct(string $value)
    {
        if (! XidService::validate($value)) {
            throw new \Exception('Invalid Xid');
        }
        $this->xid = $value;
    }

    public function get(): ?string
    {
        return $this->xid;
    }
}
