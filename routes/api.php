<?php

use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\ShoppingListItemController;
use App\Models\ShoppingList;
use App\Models\ShoppingListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource(
    'shopping-list',
    ShoppingListController::class,
    ['only' => [
        'index', 'store', 'show', 'update', 'destroy'
    ]]
);

Route::resource(
    'shopping-list-item',
    ShoppingListItemController::class,
    ['only' => [
        'index', 'store', 'show', 'update', 'destroy'
    ]]
);
