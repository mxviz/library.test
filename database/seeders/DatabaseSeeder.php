<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $publishers = Publisher::factory()->count(5)->create();
        $authors = Author::factory()->count(10)->create();

        Book::factory()->count(30)->create()->each(function($book) use ($publishers, $authors) {
            $publishersId = $publishers->random(5)->pluck('id');
            $authorsId = $authors->random(3)->pluck('id');

            $book->publishers()->attach($publishersId);
            $book->authors()->attach($authorsId);
        });
    }
}
