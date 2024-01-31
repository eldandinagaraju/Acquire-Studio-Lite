<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
            [
                "username" => "harsha@gmail.com",
                "password" => '$2a$10$fKZcNSue3gbCvGiIvT5OTeOsxFIrlINzzzYwqHN1BXaI41mWxCj2W',
            ],
            [
                "username" => "naga@gmail.com",
                "password" => '$2a$10$fKZcNSue3gbCvGiIvT5OTeOsxFIrlINzzzYwqHN1BXaI41mWxCj2W',
            ],
            [
                "username" => "vasu@gmail.com",
                "password" => '$2a$10$fKZcNSue3gbCvGiIvT5OTeOsxFIrlINzzzYwqHN1BXaI41mWxCj2W',
            ],
            [
                "username" => "snigda@gmail.com",
                "password" => '$2a$10$fKZcNSue3gbCvGiIvT5OTeOsxFIrlINzzzYwqHN1BXaI41mWxCj2W',
            ],
        ];

        $users = $this->table("users");
        $users->insert($data)->saveData();
    }
}
