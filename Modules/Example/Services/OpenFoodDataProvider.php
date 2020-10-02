<?php

namespace Modules\Example\Services;

use \GuzzleHttp\Client as HttpClient;
use Modules\Example\Exception\OpenFoodApiAccessException;

class OpenFoodDataProvider
{
    const DEFAULT_PAGE_SIZE = 20;

    public function getData(string $search, int $page): array
    {
        $httpClient = new HttpClient();
        $response = $httpClient->request('GET', env('OPEN_FOOD_API_URI') . '?' . implode('&', [
            'action=process',
            'page=' . $page,
            'search_terms2=' . $search,
            'json=1',
            'sort_by=unique_scans_n',
            'page_size=' . self::DEFAULT_PAGE_SIZE
        ]));

        if ($response->getStatusCode() !== 200) {
            throw new OpenFoodApiAccessException();
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
