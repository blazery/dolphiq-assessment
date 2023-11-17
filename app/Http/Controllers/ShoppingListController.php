<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ShoppingList::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): ShoppingList
    {
        $shoppinglist = new ShoppingList();
        $shoppinglist->name = $request->name;
        $shoppinglist->save();

        return $shoppinglist;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ShoppingList::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shoppinglist = ShoppingList::find($id);
        $shoppinglist->name = $request->name ?: $shoppinglist->name;
        $shoppinglist->save();

        return $shoppinglist;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ShoppingList::destroy($id);
        return response()->json(["status" => 200, "msg" => "resource removed"]);
    }
}
