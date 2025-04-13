<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class City extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('city');
        $table->addColumn('name', 'string', ['limit' => 100, 'null' => false])
              ->create();
    }
}
