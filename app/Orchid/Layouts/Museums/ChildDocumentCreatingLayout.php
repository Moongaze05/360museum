<?php

namespace App\Orchid\Layouts\Museums;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class ChildDocumentCreatingLayout extends Rows
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
            Input::make('child.title')
                ->title('Заголовок документа'),
            Cropper::make('child.image')
                ->title('Изображение'),
            Input::make('child.author')
                ->title('Автор документа'),
            Upload::make('child.audio')
                ->title('Аудиодорожка'),
        ];
    }
}
