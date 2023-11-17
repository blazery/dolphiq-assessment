<?php

namespace Tests\Feature;

use App\Models\ShoppingList;
use Database\Factories\ShoppingListFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShoppingListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_get_lists(): void
    {
        $response = $this->get('/api/shopping-list');
        $response->assertStatus(200);

        $json = $response->decodeResponseJson();
        $this->assertEmpty($json);
    }

    public function test_get_lists_after_populate(): void
    {
        $TESTCOUNT = 10;
        ShoppingList::factory()->count($TESTCOUNT)->create();

        $response = $this->get('/api/shopping-list');
        $response->assertStatus(200);

        $json = $response->decodeResponseJson();
        $this->assertCount($TESTCOUNT, $json);
    }

    public function test_create_list(): void
    {
        // use make insteaf of create to prevent DB save
        $fakeList = ShoppingList::factory()->make();
        $response = $this->post('/api/shopping-list', [
            'name' => $fakeList->name,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'id' => 1,
                'name' => $fakeList->name
            ]);
    }

    public function test_update_list(): void
    {
        // TODO implement
    }

    public function test_remove_list(): void
    {
        // TODO implement
    }
}
