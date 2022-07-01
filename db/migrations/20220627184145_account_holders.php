<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AccountHolders extends AbstractMigration
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
        $table = $this->table('account_holders');
        $table->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('cpf',  'string', ['limit' => 20, 'null' => true])
            ->addColumn('cnpj', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('rg',   'string', ['limit' => 20])
            ->addColumn('stateRegistration', 'string',['limit' => 30])
            ->addColumn('birthDate', 'string')
            ->addColumn('foundationDate', 'string')
            ->addColumn('cellphone', 'string', ['limit' => 20])
            ->addColumn('updated_at', 'date',['null'=>true])
            ->addColumn('created_at', 'date',['null'=>true])
            ->create();
    }
}
