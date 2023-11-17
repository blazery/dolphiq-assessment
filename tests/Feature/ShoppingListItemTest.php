<?php

namespace Tests\Feature;

use App\Models\ShoppingList;
use App\Models\ShoppingListItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShoppingListItemTest extends TestCase
{
    use RefreshDatabase;


    protected function setup_test_data()
    {
        $fakeList = ShoppingList::factory()->create();
        $fakeItem = ShoppingListItem::factory()->make();
        return [$fakeList, $fakeItem];
    }
    /**
     * A basic feature test example.
     */
    public function test_add_shopping_item(): void
    {

        [$fakeList, $fakeItem] = $this->setup_test_data();

        $response = $this->post('/api/shopping-list-item', [
            'shopping_list_id' => $fakeList->id,
            'product_name' => $fakeItem->product_name,
            'product_quantity' => $fakeItem->product_quantity,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'shopping_list_id' => $fakeList->id,
                'product_name' => $fakeItem->product_name,
                'product_quantity' => $fakeItem->product_quantity,
            ]);
        $this->assertNotEmpty($response['id']);
    }

    public function test_add_shopping_item_no_list(): void
    {
        [$fakeList, $fakeItem] = $this->setup_test_data();

        $response = $this->post('/api/shopping-list-item', [
            'product_name' => $fakeItem->product_name,
            'product_quantity' => $fakeItem->product_quantity,
        ]);

        $response->assertStatus(400);
    }

    public function test_add_shopping_item_no_name(): void
    {
        [$fakeList, $fakeItem] = $this->setup_test_data();

        $response = $this->post('/api/shopping-list-item', [
            'shopping_list_id' => $fakeList->id,
            'product_quantity' => $fakeItem->product_quantity,
        ]);

        $response->assertStatus(400);
    }

    public function test_add_shopping_item_no_quantity(): void
    {
        [$fakeList, $fakeItem] = $this->setup_test_data();

        $response = $this->post('/api/shopping-list-item', [
            'shopping_list_id' => $fakeList->id,
            'product_name' => $fakeItem->product_name,
        ]);

        $response->assertStatus(201);
    }

    public function test_update_shopping_item_quantity(): void
    {
        // setup  list linked to item
        [$fakeList, $fakeItem] = $this->setup_test_data();
        $fakeItem->shopping_list_id = $fakeList->id;
        $fakeItem->save();

        $newAmount = $fakeItem->product_quantity + 3;

        $response = $this->put("/api/shopping-list-item/$fakeItem->id", [
            'product_quantity' => $newAmount,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'product_quantity' => $newAmount,
            ]);
        $this->assertNotEmpty($response['id']);

        $s = ShoppingListItem::find($fakeItem->id);
        $this->assertEquals($newAmount, $s->product_quantity);
    }

    public function test_update_shopping_item_name(): void
    {
        // setup  list linked to item
        [$fakeList, $fakeItem] = $this->setup_test_data();
        $fakeItem->shopping_list_id = $fakeList->id;
        $fakeItem->save();

        $newName = $fakeItem->product_name . "_NEWNAME";

        $response = $this->put("/api/shopping-list-item/$fakeItem->id", [
            'product_name' => $newName,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'product_name' => $newName,
            ]);
        $this->assertNotEmpty($response['id']);

        $s = ShoppingListItem::find($fakeItem->id);
        $this->assertEquals($newName, $s->product_name);
    }

    public function test_remove_shopping_item(): void
    {
        // setup  list linked to item
        [$fakeList, $fakeItem] = $this->setup_test_data();
        $fakeItem->shopping_list_id = $fakeList->id;
        $fakeItem->save();

        $response = $this->delete("/api/shopping-list-item/$fakeItem->id");

        $response->assertStatus(200)
            ->assertJson(['status' => 200]);

        $s = ShoppingListItem::find($fakeItem->id);
        $this->assertEmpty($s);
    }

    public function test_get_all_items(): void
    {
        // TODO implement
    }

    public function test_get_item(): void
    {
        // TODO implement
    }
}
