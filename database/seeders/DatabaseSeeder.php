<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return DatabaseSeeder
     */
    public function run(): DatabaseSeeder
    {
        return $this->call([
            MuseumSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
