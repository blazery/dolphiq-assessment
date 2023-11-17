<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use App\Models\ShoppingListItem;
use Illuminate\Http\Request;

class ShoppingListItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ShoppingListItem::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): ShoppingListItem
    {
        $shoppingListitem = new ShoppingListItem();
        $shoppingListitem->shopping_list_id = 0;
        $shoppingListitem->product_name = '';
        $shoppingListitem->product_quantity = 1;
        $shoppingListitem->save();

        return $shoppingListitem;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ShoppingListItem::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): ShoppingListItem
    {
        $shoppingListItem = ShoppingListItem::find($id);

        $shoppingListItem->name = $request->product_name ?: $shoppingListItem->product_name;
        $shoppingListItem->name = $request->product_quantity ?: $shoppingListItem->product_quantity;

        $shoppingListItem->save();

        return $shoppingListItem;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ShoppingListItem::destroy($id);
        return response()->json(["status" => 200, "msg" => "resource removed"]);
    }
}
