<?php

namespace Database\Seeders;

use App\Models\Museum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class MuseumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return Collection|Model
     */
    public function run(): Collection|Model
    {
        return Museum::factory()
            ->count(2)
            ->create();
    }
}
