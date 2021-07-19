<?php

namespace App\Orchid\Layouts\Museums;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Layouts\Rows;

class MuseumPreviewLayout extends Rows
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
            Cropper::make('museum.preview')
                ->title('Предпросмотр')
                ->help('Отображается на начальном экране выбора музея')
                ->required()
        ];
    }
}
