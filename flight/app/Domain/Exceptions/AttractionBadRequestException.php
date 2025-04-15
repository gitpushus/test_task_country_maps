<?php
namespace App\Domain\Exceptions;
use Throwable;

class AttractionBadRequestException extends \Exception{
    public function __construct($message = "Bad Request"){
        return parent::__construct($message, 400);
    }
}