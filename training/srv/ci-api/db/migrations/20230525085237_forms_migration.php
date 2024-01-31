<?php


use Phinx\Migration\AbstractMigration;

class FormsMigration extends AbstractMigration
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
        $table = $this->table('forms');
        $table
        ->addColumn('form_uuid',"uuid",['length'=>36])
        ->addColumn('title','string',['limit'=>120])
        ->addColumn('created_at','datetime',['default'=>'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at','datetime',['default'=>NULL,'null'=>true])
        ->addColumn('row_status','boolean',['default'=>TRUE])
        ->addIndex(['form_uuid'],['unique'=>true])
        ->create();
    }
}
