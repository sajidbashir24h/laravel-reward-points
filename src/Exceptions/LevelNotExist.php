<?php

namespace Sajidbashir24h\Gamify\Exceptions;

use Exception;

class LevelNotExist extends Exception
{
    protected $message = 'Level must be define in gamify config file .';
}
