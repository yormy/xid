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


    private static function isValid(string $xid, bool $silent = false): bool
    {
        if (
            (strlen($xid) > 30) ||
            ! self::hasValidChecksum($xid)
        ) {
            if (!$silent) {
                Event::dispatch(new XidInvalidEvent($xid));
            }

            return false;
        }

        return true;
    }

    public static function validate(string $xid, bool $silent = false): bool
    {
        return self::isValid($xid, $silent);
    }

    public static function validateOrAbort(string $xid, bool $silent = false): bool
    {
        if (!self::isValid($xid, $silent)) {
            abort(404);
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
