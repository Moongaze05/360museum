<?php

namespace App\Orchid\Screens\Museums;

use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
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
     * @param Document $document
     * @return array
     */
    #[ArrayShape(['document' => "\App\Models\Document"])]
    public function query(Document $document): array
    {
        if ($document->exists) {
            $this->description = 'Редактирование документа';
        }

        return [
            'document' => $document
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
            Button::make('Сохранить')
                ->icon('save')
                ->method('save')
        ];
    }

    public function save(Document $document, Request $request): RedirectResponse
    {
        $document->update($request->input('document'));
        $document->save();

        return redirect()->route('museums.documents.edit', $document);
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
                Input::make('document.title')
                    ->title('Заголовок')
                    ->help('Заголовок, отображаемый в просмотрщике')
                    ->placeholder('Документ #123'),
                Input::make('document.author')
                    ->title('Автор')
                    ->help('Автор документа (например, картины)')
                    ->placeholder('Василий Васильевич'),
                TextArea::make('document.description')
                    ->title('Описание')
                    ->help('Описание, которое будет отображаться слева.
                    Можно оставить пустым, тогда панель слева отображаться не будет')
                    ->rows(6)
                    ->placeholder('Какой-нибудь текст'),
                Select::make('document.additional_id')
                    ->fromModel(Document::class, 'title', 'id'),
                Input::make('document.additional_x')->title('x'),
                Input::make('document.additional_y')->title('y'),
                Picture::make('document.image')
                    ->title('Изображение')
                    ->help('Изображение документа'),
                Upload::make('document.audio')
                    ->title('Аудиозапись')
                    ->help('Аудиозапись к документу'),
            ])
        ];
    }
}
