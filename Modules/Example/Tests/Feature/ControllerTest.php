<?php

namespace Modules\Example\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Modules\Example\Services\OpenFoodDataProvider;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

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

    public function testSave()
    {
        $response = $this->post('/search/save', ['id' => 123]);
        $response->assertStatus(400);

        $response = $this->post('/search/save', ['id' => 123, 'name' => 'test', 'image' => 'http://127.0.0.1/image.jpg', 'categories' => 'Test category, new category']);
        $response->assertRedirect('http://localhost/search');

        $this->assertDatabaseHas('food', ['id' => 123, 'name' => 'test', 'image' => 'http://127.0.0.1/image.jpg', 'categories' => 'Test category, new category']);
    }
}
