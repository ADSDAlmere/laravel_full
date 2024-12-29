<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Book;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the Books associated with the Category on a many-to-many relation.
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(book::class, 'book_category');
    }
}
