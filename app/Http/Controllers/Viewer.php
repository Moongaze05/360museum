<?php

namespace App\Http\Controllers;

use App\Models\Museum;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class Viewer extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Museum $museum
     * @return Application|Factory|View
     */
    public function __invoke(Request $request, Museum $museum): Application|Factory|View
    {
        return view('scene', [
            'museum' => $museum,
        ]);
    }
}
