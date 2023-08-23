<?php

namespace App\Exceptions;

use Exception;

class LimitOfParticipantsException extends Exception
{
    public function __construct()
    {
        parent::__construct( __('messages.number_of_participants_is_too_much'));
    }
}
