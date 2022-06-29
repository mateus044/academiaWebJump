<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Address extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('address');
        $table->addColumn('street', 'string', ['limit' => 100])
        ->addColumn('number', 'string', ['limit' => 20])
        ->addColumn('cep',  'string', ['limit' => 20])
        ->addColumn('city', 'string',['limit' => 20])
        ->addColumn('uf',   'string',['limit' => 5])
        ->addTimestamps()
        ->addColumn('accountHolder_id', 'integer',['null' => true])
        ->create();
        $table->addForeignKey('accountHolder_id', 'account_holders', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
        ->save();
    }

}
