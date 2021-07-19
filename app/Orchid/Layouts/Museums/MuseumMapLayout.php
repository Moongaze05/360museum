<?php

namespace App\Orchid\Layouts\Museums;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Layouts\Rows;

class MuseumMapLayout extends Rows
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
            Cropper::make(name: 'museum.map')
                ->title('Карта музея')
                ->required()
        ];
    }
}
