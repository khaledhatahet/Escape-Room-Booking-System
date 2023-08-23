<?php

namespace App\Exceptions;

use Exception;

class ThereIsAnotherBookingException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('messages.there_is_another_booking'));
    }
}
