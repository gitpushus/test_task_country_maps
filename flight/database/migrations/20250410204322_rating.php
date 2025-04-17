<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Rating extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('rating');
        $table->addColumn('traveler_id', 'integer', ['null' => true, 'signed' => false])
            ->addColumn('attraction_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('score', 'enum', [
                'values' => ['1', '2', '3', '4', '5'],
                'null' => false
            ])
            ->addIndex(['traveler_id', 'attraction_id'], ['unique' => true, 'name' => 'idx_traveler_attraction'])
            ->addForeignKey('traveler_id', 'traveler', 'id', [
                'delete'=> 'SET NULL', 
                'update'=> 'CASCADE',
                'constraint' => 'fk_raiting_to_traveler'
            ])
            ->addForeignKey('attraction_id', 'attraction', 'id', [
                'delete'=> 'CASCADE', 
                'update'=> 'CASCADE',
                'constraint' => 'fk_raiting_to_attraction'
            ])
            ->create();
    }
}
