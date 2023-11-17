<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ShoppingListItem extends Model
{
    use HasFactory;

    public function list(): BelongsTo
    {
        return $this->belongsTo(ShoppingList::class, 'id');
    }
}
