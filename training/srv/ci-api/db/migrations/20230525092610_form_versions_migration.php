<?php


use Phinx\Migration\AbstractMigration;

class FormVersionsMigration extends AbstractMigration
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
        $table = $this->table('form_versions');
        $table
            ->addColumn('version_uuid', 'uuid', ['length' => 36])
            ->addColumn('version_code', 'string', ['limit' => 12])
            ->addColumn('is_published', 'boolean', ['default' => false])
            ->addColumn('form_id', 'integer')
            ->addColumn('row_status', 'boolean', ['default' => TRUE])
            ->addForeignKey('form_id', 'forms', 'id', ['delete' => '', 'update' => 'CASCADE', 'delete' => 'CASCADE'])
            ->addIndex(['version_uuid'], ['unique' => true])
            ->create();             
    }
}