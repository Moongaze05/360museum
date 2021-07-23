<?php

namespace App\Orchid\Screens\Museums;

use App\Models\Document;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class DocumentScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Документ';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Создание нового документа';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Document $document): array
    {
        if ($document->exists) {
            $this->description = 'Редактирование документа';
        }

        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('')
            ])
        ];
    }
}
