<?php
namespace App\Domain\Entities;

class City
{
	public function __construct(
		public readonly ?int $id,
		public readonly string $name
	){}
}
