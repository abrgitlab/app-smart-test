<?php

namespace Modules\Example\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Example\Services\OpenFoodDataProvider;

class ExampleController extends Controller
{
    public function show(OpenFoodDataProvider $openFoodDataProvider, Request $request)
    {
        $data = [];
        if (!empty($search = $request->query->get('search'))) {
            $data = $openFoodDataProvider->getData($search, $request->query->get('page') ?? 1);
        }

        return view('example::index', [
            'input' => [
                'search' => $search
            ],
            'data' => $data
        ]);
    }

    public function search(Request $request)
    {
        return redirect()->action([self::class, 'show'], [
            'search' => $request->request->get('search') ?? '',
        ]);
    }
}
