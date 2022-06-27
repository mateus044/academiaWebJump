<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Address extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('address');
        $table->addColumn('street', 'string', ['limit' => 100])
        ->addColumn('number', 'string', ['limit' => 20])
        ->addColumn('cep',  'string', ['limit' => 20])
        ->addColumn('city', 'string',['limit' => 20])
        ->addColumn('uf',   'string',['limit' => 5])
        ->addColumn('accountholder_id', 'integer', ['null' => true])
        ->create();

        $table->addForeignKey('accountholder_id', 'account_holders', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
        ->save();

    }
}
