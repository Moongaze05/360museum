<?php

namespace App\Orchid\Layouts\Museums;

use App\Models\Scene;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ScenesTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'scenes';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make(name: 'scene.title', title: 'Название сцены')
                ->render(static fn (Scene $scene) => $scene->title),
            TD::make(name: 'scene.museum', title: 'Музей')
                ->render(static fn (Scene $scene) =>
                    Link::make($scene->museum->title)->route('museums.edit', $scene->museum)
                ),
            TD::make(name: 'scene.hotspots', title: 'Экспонаты')
                ->render(static fn (Scene $scene) => $scene->hotspots()->count()),
            TD::make('actions')
                ->render(static fn (Scene $scene) =>
                DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->route('museums.scenes.edit', $scene)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->method('remove')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->parameters($scene),
                    ])
                )
        ];
    }
}
