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

        $request->validate([
            'name' => 'required|max:255'
        ]);
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
        $list = ShoppingList::find($id);
        if (!$list) {
            return response('', 404);
        }
        return ShoppingList::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $shoppinglist = ShoppingList::find($id);
        if (!$shoppinglist) {
            return response('', 404);
        }

        $shoppinglist->name = $request->name ?: $shoppinglist->name;
        $shoppinglist->save();

        return $shoppinglist;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $result = ShoppingList::destroy($id);
        if ($result  > 0) {
            return response()->json(["status" => 200, "msg" => "resource removed"]);
        }
        return response('', 404);
    }
}
