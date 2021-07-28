<?php

namespace Database\Seeders\Real;

use App\Models\Group;
use App\Models\Museum;
use App\Models\Scene;
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

    public function talPreview(): string
    {
        return Storage::url('assets/preview1.png');
    }

    public function zirPreview(): string
    {
        return Storage::url('assets/preview2.png');
    }

    public function logo(): string
    {
        return Storage::url('assets/faceimg2.png');
    }

    public function museumTemplate(): Museum
    {
        $museum = new Museum();
        $museum->logo = $this->logo();
        return $museum;
    }

    private function museumScenes(Museum $museum, $title, array $mappings, string $panoramaFolder): void
    {
        $outdoors = new Group([
            'title' => 'Снаружи',
        ]);
        $outdoors->save();

        $newScene = static function (int $index, array $coordinates) use ($title, $panoramaFolder): Scene {
            $scene = new Scene();
            $scene->title = "$title #$index";
            $scene->panorama = Storage::url("assets/$panoramaFolder/$index.webp");
            [$scene->map_x, $scene->map_y] = $coordinates;
            return $scene;
        };

        foreach ($mappings as $key=>$mapping) {
            if (is_float($mapping[0])) {
                $scene = $newScene($key, $mapping)->group()->associate($outdoors);
                $museum->scenes()->save($scene);
            } else {
                $group = new Group([
                    'title' => "$title, зал #$key",
                ]);
                $group->save();
                foreach ($mapping as $entry) {
                    $scene = $newScene($key, $entry)->group()->associate($group);
                    $museum->scenes()->save($scene);
                }
            }
        }
    }

    public function talMap(): string
    {
        return Storage::url('assets/talMap.webp');
    }

    private array $talMapping = [
        [9.268292682926829, 79.65367965367966],
        [
            [34.146341463414636, 35.714285714285715],
            [18.048780487804876, 30.952380952380953],
            [7.317073170731707, 32.25108225108225],
            [6.829268292682928, 36.36363636363637],
            [19.51219512195122, 25.97402597402597],
            [23.902439024390244, 22.07792207792208],
            [32.6829268292683, 21.861471861471863],
            [41.951219512195124, 22.07792207792208],
        ],
        [
            [41.951219512195124, 16.450216450216452],
            [39.02439024390244, 11.904761904761903],
            [45.36585365853659, 8.441558441558442],
            [38.048780487804876, 2.380952380952381],
            [28.292682926829265, 10.606060606060606],
            [25.365853658536587, 3.67965367965368],
            [27.31707317073171, 16.017316017316016]
        ],
        [
            [56.09756097560976, 8.225108225108226],
            [70.24390243902438, 9.307359307359308],
            [82.92682926829268, 9.307359307359308]
        ],
        [
            [77.5609756097561, 17.316017316017316],
            [78.53658536585367, 24.891774891774894],
            [60.48780487804878, 28.57142857142857],
            [54.146341463414636, 16.883116883116884],
            [58.536585365853654, 25.324675324675322]
        ],
        [
            [54.63414634146342, 39.39393939393939],
            [76.09756097560975, 36.79653679653679]
        ],
        [
            [80.97560975609757, 43.722943722943725],
            [60.48780487804878, 44.8051948051948],
            [69.26829268292683, 49.134199134199136],
            [59.512195121951216, 53.246753246753244]
        ],
        [
            [80, 60.82251082251082],
            [74.14634146341463, 66.01731601731602],
            [55.1219512195122, 66.23376623376623],
            [32.19512195121951, 66.66666666666666]
        ],
        [78.53658536585367, 79.65367965367966],
    ];

    public function saveTal(): void
    {
        $tal = $this->museumTemplate();
        $tal->title = 'г. Талица';
        $tal->preview = $this->talPreview();
        $tal->map = $this->talMap();
        $tal->save();
        $this->museumScenes($tal, 'Талица', $this->talMapping, 'talPanorama');
    }


    public function zirMap(): string
    {
        return Storage::url('assets/zirMap.webp');
    }

    public array $zirMapping = [
        [39.51219512195122, 56.45645645645646],
        [
            [27.31707317073171, 34.234234234234236],
            [29.268292682926827, 21.02102102102102],
            [45.85365853658537, 8.408408408408409],
            [10.731707317073171, 8.708708708708707],
            [73.65853658536585, 26.126126126126124],
            [74.14634146341463, 7.807807807807808],
            [75.1219512195122, 15.915915915915916]
        ],
        [17.560975609756095, 63.36336336336337],
        [67.31707317073172, 72.07207207207207]
    ];

    public function saveZir(): void
    {
        $zir = $this->museumTemplate();
        $zir->title = 'д. Зырянка';
        $zir->preview = $this->zirPreview();
        $zir->map = $this->zirMap();
        $zir->save();
        $this->museumScenes($zir, 'Зырянка', $this->zirMapping, 'zirPanorama');
    }
}
