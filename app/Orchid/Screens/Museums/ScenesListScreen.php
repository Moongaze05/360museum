<?php

namespace App\Orchid\Screens\Museums;

use App\Models\Museum;
use App\Models\Scene;
use App\Orchid\Layouts\Museums\ScenesCreateLayout;
use App\Orchid\Layouts\Museums\ScenesCreateListener;
use App\Orchid\Layouts\Museums\ScenesTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Database\Eloquent\Collection;

class ScenesListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Сцены';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Сцены музеев';

    /**
     * Query data.
     *
     * @return array
     */
    #[ArrayShape([
        'scenes' => Collection::class
    ])]
    public function query(): array
    {
        return [
            'scenes' => Scene::all()
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
            ModalToggle::make('Создать')
                ->icon('plus')
                ->modal('createModal')
                ->method('createScene')
        ];
    }

    public function createScene(Request $request): RedirectResponse
    {
        $scene = new Scene($request->get('scene'));
        $scene->save();
        return redirect()->route('museums.scenes.edit', $scene);
    }

    /**
     * Views.
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            ScenesTable::class,
            Layout::modal('createModal', ScenesCreateLayout::class)
                ->title('Создание новой сцены')
                ->size(Modal::SIZE_LG)

        ];
    }
}
