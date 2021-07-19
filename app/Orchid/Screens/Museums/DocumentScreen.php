<?php

namespace App\Orchid\Screens\Museums;

use Orchid\Screen\Screen;

class DocumentScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'DocumentScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'DocumentScreen';

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
