<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SiteConfig;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $configs = SiteConfig::pluck('value', 'key')->toArray();
        $categories = ProductCategory::where('is_active', true)->get();
        $categorySlug = $request->query('categoria');
        $query = Product::where('is_active', true);
        if ($categorySlug) {
            $cat = ProductCategory::where('slug', $categorySlug)->first();
            if ($cat) {
                $query->where('product_category_id', $cat->id);
            }
        }
        $products = $query->with('category')->get();
        return view('products.index', compact('products', 'categories', 'categorySlug', 'configs'));
    }
} 