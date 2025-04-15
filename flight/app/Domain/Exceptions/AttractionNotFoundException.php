<?php
namespace App\Domain\Exceptions;
use Throwable;

class AttractionNotFoundException extends \Exception{
    public function __construct($id){
        parent::__construct("Attraction with id $id not found", 404);
    }
}