<?php

namespace App\Orchid\Layouts\Museums;

use App\Models\Scene;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Layouts\Listener;

class HotspotListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'hotspot.type',
    ];

    /**
     * What screen method should be called
     * as a source for an asynchronous request.
     *
     * The name of the method must
     * begin with the prefix "async"
     *
     * @var string
     */
    protected $asyncMethod = 'asyncChangeType';

    /**
     * @return Layout[]
     */
    protected function layouts(): array
    {
        $pointer = $this->query->get('hotspot.type') === 'scene';

        $info = !$this->query->has('hotspot.type') || $this->query->get('hotspot.type') === 'info';

        return [
            \Orchid\Support\Facades\Layout::rows([
                Select::make('hotspot.type')
                    ->title('Тип добавляемой точки')
                    ->options([
                        'info' => 'Маркер',
                        'scene' => 'Указатель'
                    ]),
                Input::make('hotspot.title')
                    ->title('Текст'),
                Select::make('hotspot.pointer_target')
                    ->title('Целевая сцена для указателя')
                    ->fromModel(Scene::class, 'title', 'id')
                    ->canSee($pointer),
                Input::make('document.title')
                    ->title('Заголовок документа')
                    ->canSee($info),
                Cropper::make('document.image')
                    ->title('Изображение')
                    ->canSee($info),
                Input::make('document.author')
                    ->title('Автор документа')
                    ->canSee($info),
                Upload::make('document.audio')
                    ->title('Аудиодорожка')
                    ->canSee($info),
            ])
        ];
    }
}
