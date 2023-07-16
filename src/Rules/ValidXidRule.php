<?php

namespace Yormy\Xid\Rules;

use Exception;
use Illuminate\Contracts\Validation\InvokableRule;
use Yormy\Xid\Observers\Events\XidInvalidEvent;
use Yormy\Xid\Services\XidService;

class ValidXidRule implements InvokableRule
{
    private ?Exception $exception;

    public function __construct(Exception $exception = null)
    {
        $this->exception = $exception;
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $isValid = XidService::validate($value);

        if (! $isValid) {
            $this->failed();

            $fail('xid.message.invalid');
        }
    }

    private function failed()
    {
        event(new XidInvalidEvent()); // When the xid is invalid this is probably a hacking attempt

        if ($this->exception) {
            throw $this->exception;
        }

        return false;
    }
}
