<?php
namespace App\Domain\Exceptions;
class TravelerBadRequestException extends \Exception{
    public function __construct($message = "Bad Request"){
        parent::__construct($message, 400);
    }
}