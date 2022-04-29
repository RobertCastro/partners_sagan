<?php

namespace Database\Seeders;

use App\Models\Data;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            "name" => "Robert Castro",
            "email" => "oneroberth@gmail.com",
            "password" => bcrypt("0JZaU@Eo"),
        ]);

        User::factory()->create([
            "name" => "Robert",
            "email" => "hello@letsbeyond.co",
            "password" => bcrypt("0JZaU@Eo"),
        ]);

        // Project::factory(2)->create();
        // Data::factory(2)->create();
    }
}
