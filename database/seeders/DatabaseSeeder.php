<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        $authors = \App\Models\Author::factory(8)->create();
        $categories = \App\Models\Category::factory(5)->create();
        
        $books = \App\Models\Book::factory(22)->create();

        $books->each(function(\App\Models\Book $bk) use($authors) {
            $bk->authors()->attach(
                $authors->random(rand(1, 2))->pluck('id')->toArray()
            );
        });

        $books->each(function(\App\Models\Book $bk) use($categories) {
            $bk->categories()->attach(
                $categories->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
