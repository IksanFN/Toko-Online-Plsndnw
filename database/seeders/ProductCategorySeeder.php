<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $productCategories = [
            [
                'name' => 'Clothes',
            ],
            [
                'name' => 'Shoes',
            ],
            [
                'name' => 'T-Shirts',
            ],
        ];

        foreach ($productCategories as $productCategory) {
            ProductCategory::create($productCategory);
        }
    }
}
