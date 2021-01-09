<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Politics', 'Science', 'Sports', 'Economy', 'Entertainment']);

        $tags->each(function($tag) {
            Tag::create([
                'name' => $tag
            ]);
        });
    }
}
