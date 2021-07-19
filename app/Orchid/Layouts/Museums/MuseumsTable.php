<?php

namespace App\Orchid\Layouts\Museums;

use App\Models\Museum;
use App\Models\Scene;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MuseumsTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'museums';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make(name: 'title', title: 'Музей')
                ->render(static fn (Museum $museum) => $museum->title),
            TD::make(name: 'scenes', title: 'Количество сцен')
                ->render(static fn (Museum $museum) => $museum->scenes()->count()),
            TD::make(name: 'hotspots', title: 'Количество экспонатов')
                ->render(static fn (Museum $museum)
                => $museum->scenes->map(static fn (Scene $scene) => $scene->hotspots())->count()),
            TD::make('Действия')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Museum $museum) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('museums.edit', $museum)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters($museum),
                        ]);
                }),
        ];
    }
}
