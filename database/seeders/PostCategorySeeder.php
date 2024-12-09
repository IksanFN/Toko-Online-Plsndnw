<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        $postCategories = [
            [
                'name' => 'Web Development',
                'slug' => Str::slug('Web Development')
            ],
            [
                'name' => 'Graphics Design',
                'slug' => Str::slug('Graphics Design')
            ],
            [
                'name' => 'Sepak Bola',
                'slug' => Str::slug('Sepak Bola')
            ]
        ];

        foreach ($postCategories as $postCategory) {
            PostCategory::create($postCategory);
        }
    }
}
