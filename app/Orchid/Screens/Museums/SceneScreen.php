<?php

namespace App\Orchid\Screens\Museums;

use App\Models\Document;
use App\Models\Hotspot;
use App\Models\Scene;
use App\Orchid\Fields\ImgMap;
use App\Orchid\Fields\PannellumDebugger;
use App\Orchid\Layouts\Museums\HotspotListener;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class SceneScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Сцена';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Добавление новой сцены';

    public Scene $scene;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Scene $scene): array
    {
        if ($scene->exists) {
            $this->description = 'Редактирование сцены';
        }

        return [
            'scene' => $scene,
            'museum' => $scene->museum
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Сохранить')
                ->icon('save')
                ->method('save')
        ];
    }

    public function save(Scene $scene, Request $request): RedirectResponse
    {
        if (!$scene->exists) {
            $scene = Scene::find($request->input('hotspot.scene'));
        }

        $scene->update($request->input('scene', []));

        $hotspot = new Hotspot(
            collect($request->get('hotspot'))->except('scene')->all()
        );

        $hotspot->scene_id = $scene->getKey();

        if (is_array($request->get('document'))) {
            $document = new Document($request->get('document'));
            $document->save();

            $hotspot->document_id = $document->getKey();
        }

        if ($hotspot->yaw !== null && $hotspot->pitch !== null) {
            $hotspot->save();
        }
        return redirect()->route('museums.scenes.edit', $scene);
    }

    #[ArrayShape(['hotspot.type' => "mixed"])]
    public function asyncChangeType(array $hotspot): array
    {
        return ['hotspot.type' => $hotspot['type']];
    }

    /**
     * Views.
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('scene.title')
                    ->title('Заголовок сцены')
                    ->help('Отображается в левом нижнем углу просмотрщика'),
            ]),
            Layout::columns([
                Layout::rows([
                    PannellumDebugger::make('scene')
                        ->urlKey('panorama')
                        ->settingsModal('newModal')
                        ->action('save'),
                ])->title('Редактор сцены'),
//                Layout::rows([
//                    ImgMap::make('museum.map')
//
//                ])->title('Сцена на карте')
            ]),
            Layout::modal('newModal', [
                HotspotListener::class
            ])->title('Добавление новой метки')
        ];
    }
}
