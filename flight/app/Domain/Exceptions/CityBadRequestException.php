<?php
namespace App\Domain\Exceptions;
class CityBadRequestException extends \Exception{
    public function __construct($message = "Bad Request")
    {
        parent::__construct($message, 400);
    }
}