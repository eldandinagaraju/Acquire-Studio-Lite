<?php


use Phinx\Migration\AbstractMigration;

class UsersMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other distructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username','string',['limit'=>100])
        ->addColumn('password','string',['limit'=>100])
        ->addColumn('role','string',['limit'=>15,'default'=>"Admin"])
        ->addColumn('created_at','datetime',['default'=>'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at','datetime',['default'=>NULL,'null'=>true])
        ->addIndex(['username'],['unique'=>true])
        ->create();
    }
}
