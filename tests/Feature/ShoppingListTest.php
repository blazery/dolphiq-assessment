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

    public function test_get_list_after_populate(): void
    {
        $fakeList = ShoppingList::factory()->create();

        $response = $this->get("/api/shopping-list/$fakeList->id");
        $response->assertStatus(200)
            ->assertJson([
                'id' => $fakeList->id
            ]);
    }

    public function test_get_list_after_populate_with_wrong_id(): void
    {
        $fakeList = ShoppingList::factory()->create();
        $response = $this->get("/api/shopping-list/12");
        $response->assertStatus(404);

        $response = $this->get("/api/shopping-list/random_id");
        $response->assertStatus(404);
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

    public function test_create_list_without_name(): void
    {
        $response = $this->post('/api/shopping-list');
        $response->assertStatus(302);

        $response = $this->post('/api/shopping-list', [], ['accept' => 'application/json']);
        $response->assertStatus(422);
    }

    public function test_update_list(): void
    {
        $fakeList = ShoppingList::factory()->create();
        $NEWNAME =  $fakeList->name . "_NEWNAME";
        $response = $this->put("/api/shopping-list/$fakeList->id", [
            'name' => $NEWNAME
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $fakeList->id,
                'name' => $NEWNAME
            ]);

        $list = ShoppingList::find($fakeList->id);
        $this->assertNotEmpty($list);
        $this->assertEquals($NEWNAME, $list->name);
    }

    public function test_update_list_without_name(): void
    {
        $fakeList = ShoppingList::factory()->create();
        // add header to test XHR request instead of standard webrequest
        $response = $this->put("/api/shopping-list/$fakeList->id", [], ["Accept" => "application/json"]);

        $response->assertStatus(422);
    }

    public function test_update_list_with_wrong_id(): void
    {
        $fakeList = ShoppingList::factory()->create();
        $NEWNAME =  $fakeList->name . "_NEWNAME";
        $response = $this->put("/api/shopping-list/random_id", [
            'name' => $NEWNAME
        ]);

        $response->assertStatus(404);
    }

    public function test_remove_list(): void
    {
        $fakeList = ShoppingList::factory()->create();
        $response = $this->delete("/api/shopping-list/$fakeList->id");

        $response->assertStatus(200)
            ->assertJson([
                'status' => 200
            ]);

        $list = ShoppingList::find($fakeList->id);
        $this->assertEmpty($list);
    }

    public function test_remove_list_incorrect_id(): void
    {
        $fakeList = ShoppingList::factory()->create();
        $response = $this->delete("/api/shopping-list/12");

        $response->assertStatus(404);
    }
}
