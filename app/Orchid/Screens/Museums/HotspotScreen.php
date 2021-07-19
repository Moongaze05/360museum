<?php

namespace App\Orchid\Screens\Museums;

use Orchid\Screen\Screen;

class HotspotScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'HotspotScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'HotspotScreen';

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
