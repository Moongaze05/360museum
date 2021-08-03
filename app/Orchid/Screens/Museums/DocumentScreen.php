<?php

namespace App\Orchid\Screens\Museums;

use App\Models\Document;
use App\Orchid\Fields\ImgMap;
use App\Orchid\Layouts\Museums\ChildDocumentCreatingLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
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
    #[ArrayShape(['document' => Document::class])]
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
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Сохранить')
                ->icon('save')
                ->method('save'),
            Button::make('Удалить')
                ->icon('trash')
                ->method('delete')
        ];
    }

    public function delete(Document $document, Request $request): RedirectResponse
    {
        $document->hotspots()->delete();
        $document->delete();

        return redirect()->route('museums.documents.all');
    }

    public function save(Document $document, Request $request): RedirectResponse
    {
        $document = $document->exists ? $document : Document::find($request->input('parent_id'));

        if ($request->has('child')) {
            $child = new Document($request->input('child'));
            [
                'parent_x' => $child->parent_x,
                'parent_y' => $child->parent_y
            ] = $request->input('additional');
            $document->additional()->save($child);
        }

        if ($request->has('document')) {
            $document->update($request->input('document'));
            $document->save();
        }


        return redirect()->route('museums.documents.edit', $document->getKey());
    }

    /**
     * Views.
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            Layout::columns([
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
                    Picture::make('document.image')
                        ->title('Изображение')
                        ->help('Изображение документа'),
                    Upload::make('document.audio')
                        ->title('Аудиозапись')
                        ->help('Аудиозапись к документу'),
                ]),
                Layout::rows([
                    ImgMap::make('document')
                        ->settingsModal('newModal')
                        ->action('save')
                ])
            ]),
            Layout::modal('newModal', [
                ChildDocumentCreatingLayout::class
            ])->title('Добавление дочернего документа')
        ];
    }
}
