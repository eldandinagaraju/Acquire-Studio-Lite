<?php


use Phinx\Migration\AbstractMigration;

class QuestionsMigration extends AbstractMigration
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
        $table = $this->table('questions')
        ->addColumn('question_text','string',['limit'=>200])
        ->addColumn('question_type','string',['null'=>false])
        ->addColumn('question_uuid','uuid',['length'=>36])
        ->addColumn('options','json',['null'=>true,'default'=>NULL])
        ->addColumn('section_id','integer')
        ->addColumn('relational_operation','string',['null'=>true,'default'=>NULL])
        ->addColumn('correct_response','json',['null'=>true,'default'=>NULL])
        ->addColumn('related_to','integer',['null'=>true,'default'=>NULL])
        ->addColumn('row_status','boolean',['default'=>TRUE])
        ->addForeignKey('related_to','questions','id',['delete'=>'CASCADE','update'=>'CASCADE'])
        ->addForeignKey('section_id','sections','id',['delete'=>'CASCADE','update'=>'CASCADE'])
        ->addIndex(['question_uuid'],['unique'=>true])
        ->create();        
    }
}
