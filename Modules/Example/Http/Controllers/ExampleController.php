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

        $page = $request->query->get('page') ?? null;
        if (($search = $request->query->get('search')) !== null) {
            $data = $openFoodDataProvider->getData($search, $page ?? 1);
        }

        return view('example::index', [
            'input' => [
                'search' => $search,
                'page' => $page
            ],
            'data' => $data
        ]);
    }

    public function search(Request $request)
    {
        return redirect()->action([self::class, 'show'], [
            'search' => $request->request->get('search'),
        ]);
    }

    public function save(Request $request)
    {
        $chosen = $request->request->get('chosen');

        //TODO: save to db

        return redirect()->action([self::class, 'show'], [
            'search' => $request->query->get('search'),
            'page' => $request->query->get('page'),
        ]);
    }
}
