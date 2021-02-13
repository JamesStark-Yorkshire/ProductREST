<?php

namespace Http\Controllers;

use Faker;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductControllerTest extends \TestCase
{
    use DatabaseMigrations;

    /**
     * Test List Product
     *
     * @return void
     */
    public function testList()
    {
        Product::factory()->count(100)->create();

        $this->get('/api/product')
            ->seeJsonStructure([
                'data',
                'links',
                'meta'
            ]);
    }

    /**
     * Test Create Product
     *
     * @return void
     */
    public function testStore()
    {
        $payload = Product::factory()->make()->toArray();

        $this->post('/api/product', $payload)
            ->seeJsonContains($payload)
            ->seeJsonContains(['product_id' => 1])
            ->assertResponseStatus(JsonResponse::HTTP_CREATED);
    }

    /**
     * Test Show Product
     *
     * @return void
     */
    public function testShow()
    {
        $product = Product::factory()->create();

        $this->get('/api/product/'. $product->getKey())
            ->seeJsonEquals($product->toArray());
    }

    /**
     * Test Update Product
     *
     * @return void
     */
    public function testUpdate()
    {
        $product = Product::factory()->create();

        $payload = Product::factory()->make()->toArray();

        $this->put('/api/product/'. $product->getKey(), $payload)
            ->seeJsonContains($payload);
    }

    /**
     * Test Delete Product
     *
     * @return void
     */
    public function testDelete()
    {
        $product = Product::factory()->create();

        $this->delete('/api/product/'. $product->getKey())
            ->seeJsonEquals($product->toArray())
            ->assertResponseOk();

        // Check if item deleted
        $this->assertNull(Product::find($product->getKey()));
    }
}
