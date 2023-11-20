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
    public function store(Request $request)
    {
        $request->validate([
            'shopping_list_id' => 'required|numeric|integer',
            'product_name' => 'required|max:255',
            'product_quantity' => 'numeric|integer',
        ]);

        $shoppingListitem = new ShoppingListItem();
        $shoppingListitem->shopping_list_id = $request->shopping_list_id;
        $shoppingListitem->product_name = $request->product_name;
        $shoppingListitem->product_quantity = $request->product_quantity ?: 1;
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

        $request->validate([
            'product_name' => 'string|max:255',
            'product_quantity' => 'numeric|integer',
        ]);

        $shoppingListItem->product_name = $request->product_name ?: $shoppingListItem->product_name;
        $shoppingListItem->product_quantity = $request->product_quantity ?: $shoppingListItem->product_quantity;

        $shoppingListItem->save();

        return $shoppingListItem;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = ShoppingListItem::destroy($id);
        if ($result  > 0) {
            return response()->json(["status" => 200, "msg" => "resource removed"]);
        }
        return response('', 404);
    }
}
