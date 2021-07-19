<?php

namespace App\Orchid\Layouts\Museums;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class MuseumTitleLayout extends Rows
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
            Input::make(name: 'museum.title')
                ->type('text')
                ->required()
                ->title('Город музея')
                ->placeholder('Новый замечательный музей')
                ->help('Будет отображаться на главном экране при выборе музея')
        ];
    }
}
