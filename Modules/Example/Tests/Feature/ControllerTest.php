<?php

namespace Modules\Example\Tests\Feature;

use Mockery;
use Modules\Example\Services\OpenFoodDataProvider;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    public function testShow()
    {
        $this->instance(OpenFoodDataProvider::class, Mockery::mock(OpenFoodDataProvider::class, function ($mock) {
            $mock->shouldNotReceive('getData');
        }));

        $response = $this->get('/search');
        $response->assertStatus(200);

        $response = $this->get('/search?page=1');
        $response->assertStatus(200);

        $response = $this->get('/search?page=10');
        $response->assertStatus(200);
    }

    public function testShowWithSearch()
    {
        $this->instance(OpenFoodDataProvider::class, Mockery::mock(OpenFoodDataProvider::class, function ($mock) {
            $mock->shouldReceive('getData')->times(3);
        }));

        $response = $this->get('/search?search=donut');
        $response->assertStatus(200);

        $response = $this->get('/search?search=donut&page=1');
        $response->assertStatus(200);

        $response = $this->get('/search?search=donut&page=10');
        $response->assertStatus(200);
    }
}
