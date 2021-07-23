<?php

namespace App\Orchid\Screens\Museums;

use App\Models\Document;
use App\Orchid\Layouts\Museums\DocumentsTable;
use Orchid\Screen\Screen;

class DocumentsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Документы';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Список загруженных документов';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'documents' => Document::all()
        ];
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
            DocumentsTable::class
        ];
    }
}
