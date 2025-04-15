<?php
namespace App\Domain\Exceptions;
class CityNotFoundException extends \Exception{
    public function __construct(int $id)
    {
        parent::__construct("City with id $id not found", 404);
    }
}