<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'title',
        'description',
        'ISBN',
        // 'author_id',
        // 'category_id',
    ];
    public $sortable = ['title',
        'description',
        'ISBN',
    ];

    /**
     * Get the Categories associated with the Book.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }
    /**
     * Get the Author associated with the Book.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}
