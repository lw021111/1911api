<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class ApiExceptions extends \Exception
{
   public function __construct($message='', $code=100)
   {
       parent::__construct($message, $code);
   }
}
