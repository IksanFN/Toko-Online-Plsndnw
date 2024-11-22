<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        $postCategories = [
            [
                'name' => 'Web Development',
            ],
            [
                'name' => 'Graphics Design',
            ],
            [
                'name' => 'Sepak Bola',
            ]
        ];

        foreach ($postCategories as $postCategory) {
            PostCategory::create($postCategory);
        }
    }
}
