<?php

namespace App\Orchid\Layouts\Museums;

use App\Models\Museum;
use App\Orchid\Fields\ImgMap;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class ScenesCreateLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Select::make('scene.museum_id')
                ->fromModel(Museum::class, 'title', 'id')
                ->title('Музей')
                ->help('Музей, в котором будет размещена новая сцена'),
            Input::make('scene.title')
                ->title('Название')
                ->placeholder('Наша новая сцена')
                ->help('Будет отображаться в просмотрщике в левом нижнем углу'),
            Cropper::make('scene.panorama')
                ->title('Панорама')
                ->help('Загрузите панораму для сцены'),
        ];
    }
}
