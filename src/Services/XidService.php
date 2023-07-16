<?php

namespace Yormy\Xid\Services;

use Illuminate\Support\Facades\Event;
use Xuid\Xuid;
use Yormy\Xid\Observers\Events\XidInvalidEvent;

class XidService
{
    public static function generate(): string
    {
        Xuid::setMap(
            [
                '+' => 'Æ',
                '/' => 'Ä',
            ]
        );

        $xid = Xuid::getXuid();

        return $xid.''.substr((string) abs(crc32($xid)), 0, 3);
    }

    public static function validate(string $xid): bool
    {
        if (
            (strlen($xid) > 30) ||
            ! self::hasValidChecksum($xid)
        ) {
            Event::dispatch(new XidInvalidEvent());

            return false;
        }

        return true;
    }

    private static function hasValidChecksum(string $xid): bool
    {
        $crc = substr($xid, strlen($xid) - 3, 3);
        $org = substr($xid, 0, strlen($xid) - 3);

        $recalcCrc = substr((string) abs(crc32($org)), 0, 3);

        return $recalcCrc === $crc;
    }
}
