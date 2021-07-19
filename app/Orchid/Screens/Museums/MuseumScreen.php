<?php

namespace App\Orchid\Screens\Museums;

use App\Models\Museum;
use App\Orchid\Layouts\Museums\MuseumLogoLayout;
use App\Orchid\Layouts\Museums\MuseumMapLayout;
use App\Orchid\Layouts\Museums\MuseumPreviewLayout;
use App\Orchid\Layouts\Museums\MuseumTitleLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class MuseumScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Музей';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Добавление нового музея';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Museum $museum): array
    {
        if ($museum->exists) {
            $this->description = 'Редактирование музея';
        }
        return [
            'museum' => $museum
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(name: 'Сохранить')
                ->icon('save')
                ->method('save')
        ];
    }

    public function save(Museum $museum, Request $request)
    {
        $museum
            ->fill($request->get('museum'))
            ->save();
        return redirect()->route('museums.edit', $museum);
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::block(MuseumTitleLayout::class)
                ->title('Город')
                ->description('Отображаемый город музея'),
            Layout::block(MuseumMapLayout::class)
                ->title('Карта')
                ->description('Карта музея внутри экскурсии'),
            Layout::block(MuseumPreviewLayout::class)
                ->title('Предпросмотр')
                ->description('Изображение предпросмотра'),
            Layout::block(MuseumLogoLayout::class)
                ->title('Название')
                ->description('Название (Логотип) музея'),
        ];
    }
}
