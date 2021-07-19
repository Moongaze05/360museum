<?php

namespace App\Orchid\Screens\Museums;

use App\Models\Museum;
use App\Orchid\Layouts\Museums\MuseumsTable;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class MuseumsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Музеи';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Список музеев';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'museums' => Museum::all(),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Добавить')
                ->icon('plus')
                ->method('newMuseum')
        ];
    }

    public function newMuseum(): RedirectResponse
    {
        return redirect()->route('museums.edit');
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            MuseumsTable::class
        ];
    }
}
