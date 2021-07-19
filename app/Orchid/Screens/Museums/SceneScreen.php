<?php

namespace App\Orchid\Screens\Museums;

use Orchid\Screen\Screen;

class SceneScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'SceneScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'SceneScreen';

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
