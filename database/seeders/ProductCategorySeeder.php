<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $productCategories = [
            [
                'name' => 'Clothes',
                'slug' => Str::slug('Clothes')
            ],
            [
                'name' => 'Shoes',
                'slug' => Str::slug('Shoes')
            ],
            [
                'name' => 'T-Shirts',
                'slug' => Str::slug('T-Shirts')
            ],
        ];

        foreach ($productCategories as $productCategory) {
            ProductCategory::create($productCategory);
        }
    }
}
