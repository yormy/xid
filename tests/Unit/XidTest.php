<?php

namespace Yormy\Xid\Tests\Unit;

use Illuminate\Support\Facades\Event;
use Yormy\Xid\Observers\Events\XidInvalidEvent;
use Yormy\Xid\Rules\ValidXidRule;
use Yormy\Xid\Services\XidService;
use Yormy\Xid\Tests\TestCase;
use Yormy\Xid\ValueObjects\Xid;

class XidTest extends TestCase
{
    /** @test */
    public function canGenerate()
    {
        $xid = XidService::generate();

        $this->assertTrue(strlen($xid) > 22);
    }

    /** @test */
    public function xidIsValid()
    {
        $xid = XidService::generate();

        $this->assertTrue(XidService::validate($xid));
    }

    /** @test */
    public function xidIsNotValid()
    {
        $xid = XidService::generate();

        $xid .= 'p';

        $this->assertFalse(XidService::validate($xid));
    }

    /** @test */
    public function instantiate_valid_oke()
    {
        $xid = XidService::generate();

        try {
            new Xid($xid);
            $this->assertTrue(true);
        } catch (\Exception) {
            $this->assertTrue(false);
        }
    }

    /** @test */
    public function instantiate_invalid_throws_exception_and_fires_event()
    {
        $xid = XidService::generate();
        $xid .= 'l';

        Event::fake();

        try {
            new Xid($xid);
            Event::assertDispatched(XidInvalidEvent::class);
            $this->assertTrue(false);
        } catch (\Exception) {
            $this->assertTrue(true);
        }
    }

    /** @test */
    public function validateRuleOke()
    {
        $validationRule = new ValidXidRule();

        /** @psalm-suppress InvalidArgument */
        $validationRule->__invoke('field',XidService::generate(), function () {
            $this->assertTrue(false); // should not call failure
        });

        $this->assertTrue(true);
    }

    /** @test */
    public function invalid_rule_event_fired()
    {
        Event::fake();

        $validationRule = new ValidXidRule();
        /** @psalm-suppress InvalidArgument */
        $validationRule->__invoke('field','xxx', function () {
            Event::assertDispatched(XidInvalidEvent::class);
            $this->assertTrue(true);
        });



    }
}
