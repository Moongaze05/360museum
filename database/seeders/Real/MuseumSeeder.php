<?php

namespace Database\Seeders\Real;

use App\Models\Museum;
use App\Models\Scene;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MuseumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        $panorama1 = Storage::url('assets/img1.webp');
        $panorama2 = Storage::url('assets/img2.webp');
        $preview = Storage::url('assets/preview1.png');
        $logo = Storage::url('assets/faceimg2.png');
        $map = Storage::url('assets/test.png');

        $tal = new Museum();
        $tal->title = 'г. Талица';
        $tal->preview = $preview;
        $tal->logo = $logo;
        $tal->map = $map;
        $talScene = new Scene();

        $talScene->title = $tal->title.' test';
        $talScene->panorama = $panorama1;

        $tal->save();
        $tal->scenes()->save($talScene);

        $zir = new Museum();
        $zir->title = 'д. Зырянка';
        $zir->preview = $preview;
        $zir->logo = $logo;
        $zir->map = $map;
        $zirScene = new Scene();

        $zirScene->title = $zir->title.' test';
        $zirScene->panorama = $panorama2;

        $zir->save();
        $zir->scenes()->save($zirScene);


    }
}
