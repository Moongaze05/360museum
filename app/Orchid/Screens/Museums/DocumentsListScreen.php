<?php

namespace App\Orchid\Screens\Museums;

use Orchid\Screen\Screen;

class DocumentsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'DocumentsListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'DocumentsListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
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
        return [];
    }
}
