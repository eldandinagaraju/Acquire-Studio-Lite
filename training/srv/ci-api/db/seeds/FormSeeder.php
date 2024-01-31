<?php

use Phinx\Seed\AbstractSeed;

class FormSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */

    public function run()
    {
        $data = [
            ["form_uuid" => uniqid(), "title" => "Test Form 1"],
            ["form_uuid" => uniqid(), "title" => "Test Form 2"],
            ["form_uuid" => uniqid(), "title" => "Test Form 3"],
        ];

        $forms = $this->table("forms");
        $forms->insert($data)->saveData();
    }
}
