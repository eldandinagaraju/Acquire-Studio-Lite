<?php

use Phinx\Seed\AbstractSeed;

class FormVersionSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function getDependencies()
    {
        return ["FormSeeder"];
    }

    public function run()
    {
        $formIds = $this->adapter->fetchAll("select id from forms");

        for ($i = 0; $i < 10; $i++) {
            $versions[] = "v".$i;
        }

        foreach ($formIds as $formItem) {
            foreach ($versions as $version) {
                $data[] = [
                    "version_uuid" => uniqid(),
                    "version_code" => $version,
                    "form_id" => $formItem["id"],
                ];
            }
        }

        $versions = $this->table("form_versions");
        $versions->insert($data)->saveData();
    }
}
