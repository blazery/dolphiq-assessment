<?php

namespace Database\Factories;

use App\Models\ShoppingListItem;
use Illuminate\Database\Eloquent\Factories\Factory;


class ShoppingListItemFactory extends Factory
{

    protected $model = ShoppingListItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shopping_list_id' => rand(1, 9999),
            'product_name' => fake()->name(),
            'product_quantity' => rand(1, 25)
        ];
    }
}
