<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = ProductCategory::all();
        $products = [
            [
                'name' => 'Smartphone X',
                'description' => 'Smartphone de última geração',
                'price' => 2999.90,
                'stock' => 10,
                'image' => null,
                'category' => 'eletronicos',
            ],
            [
                'name' => 'Camiseta Algodão',
                'description' => 'Camiseta confortável 100% algodão',
                'price' => 59.90,
                'stock' => 50,
                'image' => null,
                'category' => 'roupas',
            ],
            [
                'name' => 'Livro de Laravel',
                'description' => 'Aprenda Laravel do zero ao avançado',
                'price' => 89.90,
                'stock' => 30,
                'image' => null,
                'category' => 'livros',
            ],
        ];
        foreach ($products as $prod) {
            $cat = $categories->where('slug', $prod['category'])->first();
            if ($cat) {
                Product::create([
                    'name' => $prod['name'],
                    'slug' => Str::slug($prod['name']),
                    'description' => $prod['description'],
                    'price' => $prod['price'],
                    'stock' => $prod['stock'],
                    'image' => $prod['image'],
                    'product_category_id' => $cat->id,
                    'is_active' => true
                ]);
            }
        }
    }
} 