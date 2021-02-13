<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'product_name' => $this->faker->company,
            'product_desc' => $this->faker->realText(),
            'product_category' => $this->faker->colorName,
            'product_price' => $this->faker->randomFloat(2, 0, 100)
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Product $product) {
            $data = $this->generateLocalesProductDetails();
            $product->productDetails()->makeMany($data);
        })->afterCreating(function (Product $product) {
            $data = $this->generateLocalesProductDetails();
            $product->productDetails()->createMany($data);
        });
    }

    /**
     * Generate locale product details
     *
     * @return array
     */
    private function generateLocalesProductDetails(): array
    {
        $locales = ['en-gb', 'fr-ch'];

        $payload = [];

        foreach($locales as $locale){
            $payload = array_merge($payload, $this->generateProductDetails($locale));
        }

        return $payload;
    }

    /**
     * Generate Product Details
     *
     * @param string|null $locale
     * @return array
     */
    private function generateProductDetails(string $locale = null): array
    {
        $locale = $locale ?? config('app.locale');

        $fields = [
            'product_name' => $this->faker->firstName,
            'product_desc' => $this->faker->realText(),
            'product_category' => $this->faker->colorName
        ];

        $payload = [];

        foreach ($fields as $key => $value) {
            $payload[] = [
                'locale' => $locale,
                'key' => $key,
                'value' => $value
            ];
        }

        return $payload;
    }
}
