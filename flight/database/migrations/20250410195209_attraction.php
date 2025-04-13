<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class Attraction extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('attraction');
        $table->addColumn('name', 'string', ['limit' => 100, 'null' => false])
        ->addColumn('distance_from_center', 'integer', ['limit' => MysqlAdapter::INT_SMALL, 'null' => false])
        ->addColumn('city_id', 'integer', ['null' => false, 'signed' => false])
        ->addIndex(['city_id', 'name'], [
            'unique' => true,
            'name' => 'idx_city_name'
            ])
        ->addForeignKey('city_id', 'city', 'id', [
            'delete'=> 'CASCADE', 
            'update'=> 'CASCADE',
            'constraint' => 'fk_attraction_to_city'
        ])
        ->create();
    }
}
