<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $books = [
            ['name' => 'Fiction', 'description' => 'Fiction books'],
            ['name' => 'Non-Fiction', 'description' => 'Non-Fiction books'],
            ['name' => 'Science Fiction', 'description' => 'Science Fiction books'],
            ['name' => 'Fantasy', 'description' => 'Fantasy books'],
            ['name' => 'Mystery', 'description' => 'Mystery books'],
            ['name' => 'Romance', 'description' => 'Romance books'],
            ['name' => 'Horror', 'description' => 'Horror books'],
            ['name' => 'Web Development', 'description' => 'Web Development books'],
            ['name' => 'Mobile Development', 'description' => 'Mobile Development books'],
            ['name' => 'Game Development', 'description' => 'Game Development books'],
            ['name' => 'Software Development', 'description' => 'Software Development books'],
            ['name' => 'Database', 'description' => 'Database books'],
            ['name' => 'Networking', 'description' => 'Networking books'],
            ['name' => 'Security', 'description' => 'Security books'],
            ['name' => 'Operating Systems', 'description' => 'Operating Systems books'],
            ['name' => 'Cloud Computing', 'description' => 'Cloud Computing books']
        ];
        // Seed the categorys table
        foreach($books as $book) {
            $category = Category::create($book);
        }
        // Category::factory(10)->create();
    }
}
