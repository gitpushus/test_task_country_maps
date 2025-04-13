<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Traveler extends AbstractMigration
{
   public function change(): void
    {
        $table = $this->table('traveler');
        $table->addColumn('name', 'string', ['limit' => 100, 'null' => false])
              ->create();
    }
}
