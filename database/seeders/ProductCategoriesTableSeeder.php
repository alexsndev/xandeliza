<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Eletrônicos', 'description' => 'Produtos eletrônicos em geral', 'image' => null],
            ['name' => 'Roupas', 'description' => 'Moda e vestuário', 'image' => null],
            ['name' => 'Livros', 'description' => 'Livros e literatura', 'image' => null],
        ];
        foreach ($categories as $cat) {
            ProductCategory::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
                'image' => $cat['image'],
                'is_active' => true
            ]);
        }
    }
} 