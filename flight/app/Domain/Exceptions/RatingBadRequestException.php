<?php
namespace App\Domain\Exceptions;

class RatingBadRequestException extends \Exception{
    public function __construct($message = "Bad Request"){
        return parent::__construct($message, 400);
    }
}