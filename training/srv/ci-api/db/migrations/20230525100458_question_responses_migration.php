<?php


use Phinx\Migration\AbstractMigration;

class QuestionResponsesMigration extends AbstractMigration
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
        $table = $this->table('question_responses');
        $table
        ->addColumn('question_id','integer')
        ->addColumn('user_id','integer')
        ->addColumn('response','json',['null'=>true,'default'=>NULL])
        ->addForeignKey('question_id','questions','id',['delete'=>'CASCADE','update'=>'CASCADE'])
        ->addForeignKey('user_id','users','id',['delete'=>'CASCADE','update'=>'CASCADE'])
        ->create();
    }
}
