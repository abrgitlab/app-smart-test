<?php

namespace Modules\Example\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Example\Entities\Food;
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
                'page' => (int) $page,
                'totalPages' => (!empty($data)) ? (int) ceil($data['count'] / $data['page_size']) : 0,
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
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'image' => 'required',
            'categories' => 'required',
        ]);

        Food::updateOrCreate($request->request->all());

        return redirect()->action([self::class, 'show'], [
            'search' => $request->query->get('search'),
            'page' => $request->query->get('page'),
        ]);
    }
}
