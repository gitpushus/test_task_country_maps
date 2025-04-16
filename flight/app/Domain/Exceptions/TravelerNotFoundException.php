<?php
namespace App\Domain\Exceptions;
use Throwable;

class TravelerNotFoundException extends \Exception{
    public function __construct(int $id){
        parent::__construct("Traveler with id $id not found", 404);
    }
}