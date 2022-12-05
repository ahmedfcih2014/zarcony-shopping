<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->text(50);
        return [
            'title' => $title,
            'sku' => Str::slug(fake()->numerify("##") .'-'. $title .'-'. fake()->numerify("##-##")),
            'details' => fake()->realText,
            'price' => fake()->numerify("##.##"),
            'brand_id' => 1
        ];
    }
}
