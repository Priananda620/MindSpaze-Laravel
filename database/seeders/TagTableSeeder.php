<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // http://country.io/phone.json

    public function run()
    {
        $tags = [
            'nature',
            'cars',
            'technology',
            'travel',
            'food',
            'sports',
            'music',
            'books',
            'movies',
            'fashion',
            'fitness',
            'art',
            'photography',
            'health',
            'business',
            'finance',
            'education',
            'science',
            'history',
            'gaming',
            'politics',
            'programming',
            'design',
            'culture',
            'environment',
            'animals',
            'architecture',
            'celebrities',
            'comedy',
            'crafts',
            'gardening',
            'hobbies',
            'languages',
            'mindfulness',
            'parenting',
            'relationships',
            'self-improvement',
            'trivia',
            'wellness',
            'yoga',
            'cooking',
            'meditation',
            'productivity',
            'writing',
            'entrepreneurship',
            'marketing',
            'startups',
            'motivation',
        ];

        $tagData = [];

        foreach ($tags as $tag) {
            $tagData[] = [
                'tag_name' => $tag,
            ];
        }

        DB::table('tags')->insert($tagData);
    }
}
