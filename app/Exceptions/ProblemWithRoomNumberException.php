<?php

namespace App\Exceptions;

use Exception;

class ProblemWithRoomNumberException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('messages.problem_with_room_number'));
    }
}
