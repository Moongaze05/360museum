<?php

namespace App\Orchid\Layouts\Museums;

use App\Models\Document;
use App\Models\Hotspot;
use App\Models\Museum;
use App\Models\Scene;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class DocumentsTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'documents';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('title', 'Заголовок'),
            TD::make('author', 'Автор'),
            TD::make('scene', 'Сцены')
                ->render(fn (Document $document) =>
                    $document->hotspots->count()),
            TD::make('actions')
                ->render(static fn (Document $document) =>
                DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->route('museums.documents.edit', $document)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->method('remove')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->parameters($document),
                    ])
                )
        ];
    }
}
