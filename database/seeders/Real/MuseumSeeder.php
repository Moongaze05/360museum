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
        $this->saveTal();
        $this->saveZir();
    }

    public function preview(): string
    {
        return Storage::url('assets/preview1.png');
    }

    public function logo(): string
    {
        return Storage::url('assets/faceimg2.png');
    }

    public function museumTemplate(): Museum
    {
        $museum = new Museum();
        $museum->preview = $this->preview();
        $museum->logo = $this->logo();
        return $museum;
    }

    private function museumScenes(Museum $museum, $title, array $mappings, string $panoramaFolder): void
    {
        foreach ($mappings as $key=>$mapping) {
            $scene = new Scene();
            $scene->title = "$title #$key";
            $scene->panorama = Storage::url("assets/$panoramaFolder/$key.webp");
            [$scene->map_x, $scene->map_y] = $mapping;
            $museum->scenes()->save($scene);
        }
    }

    public function talMap(): string
    {
        return Storage::url('assets/talMap.png');
    }

    private array $talMapping = [
        [31.428571428571427, 65.5],
        [44.857142857142854, 49],
        [31.142857142857146, 41.75],
        [23.142857142857142, 43.75],
        [23.142857142857142, 50.74999999999999],
        [32, 35.75],
        [34.285714285714285, 30],
        [40.285714285714285, 29.75],
        [46.85714285714286, 31.25],
        [47.14285714285714, 21.75],
        [47.42857142857143, 15],
        [47.42857142857143, 10.25],
        [43.714285714285715, 2.5],
        [37.42857142857143, 14.000000000000002],
        [36.285714285714285, 4.5],
        [36.857142857142854, 20.5],
        [57.99999999999999, 12.75],
        [67.71428571428572, 12.25],
        [76, 13.5],
        [71.42857142857143, 22.75],
        [71.14285714285714, 33.75],
        [60.285714285714285, 38.5],
        [55.714285714285715, 22.25],
        [56.00000000000001, 30.25],
        [55.42857142857143, 52.5],
        [70.28571428571428, 47.75],
        [73.42857142857143, 60.25],
        [59.71428571428572, 60.75000000000001],
        [66.28571428571428, 65.75],
        [58.857142857142854, 72.75],
        [74, 80.75],
        [71.42857142857143, 88.25],
        [56.00000000000001, 88],
        [39.42857142857143, 87.75],
        [40.285714285714285, 65.5]
    ];

    public function saveTal(): void
    {
        $tal = $this->museumTemplate();
        $tal->title = 'г. Талица';
        $tal->map = $this->talMap();
        $tal->save();
        $this->museumScenes($tal, 'Талица', $this->talMapping, 'talPanorama');
    }


    public function zirMap(): string
    {
        return Storage::url('assets/zirMap.png');
    }

    public array $zirMapping = [
        [28.285714285714285, 46.5],
        [53.142857142857146, 38.25],
        [62.57142857142857, 38.25],
        [85.14285714285714, 37.75],
        [86.85714285714286, 48.5],
        [84.85714285714285, 27],
        [67.71428571428572, 68.5],
        [88, 67.75],
        [76.28571428571429, 68],
        [21.714285714285715, 30.75],
        [9.142857142857142, 65.5]
    ];

    public function saveZir(): void
    {
        $zir = $this->museumTemplate();
        $zir->title = 'д. Зырянка';
        $zir->map = $this->zirMap();
        $zir->save();
        $this->museumScenes($zir, 'Зырянка', $this->zirMapping, 'zirPanorama');
    }
}
