<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class AdminProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create product categories
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'created_by' => 'admin@s-commerce.com',
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'created_by' => 'admin@s-commerce.com',
            ],
        ];
        foreach ($categories as $category) {
            // check if category exists with same slug
            $exists = ProductCategory::where('slug', $category['slug'])->first();
            if (! $exists) {
                ProductCategory::create($category);
            }
        }
    }
}
