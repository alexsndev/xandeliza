<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'title' => 'Categoria 1',
                'icon_type' => 'svg',
                'icon_content' => '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>',
                'stroke_color' => '#111827',
                'icon_color' => '#2563eb',
                'order' => 1,
            ],
            [
                'title' => 'Categoria 2',
                'icon_type' => 'svg',
                'icon_content' => '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="8"/></svg>',
                'stroke_color' => '#eab308',
                'icon_color' => '#f59e42',
                'order' => 2,
            ],
            [
                'title' => 'Categoria 3',
                'icon_type' => 'svg',
                'icon_content' => '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12,2 22,22 2,22"/></svg>',
                'stroke_color' => '#059669',
                'icon_color' => '#10b981',
                'order' => 3,
            ],
            [
                'title' => 'Categoria 4',
                'icon_type' => 'svg',
                'icon_content' => '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="6" y="6" width="12" height="12" rx="6"/></svg>',
                'stroke_color' => '#d97706',
                'icon_color' => '#f59e42',
                'order' => 4,
            ],
            [
                'title' => 'Categoria 5',
                'icon_type' => 'svg',
                'icon_content' => '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="10" ry="6"/></svg>',
                'stroke_color' => '#be185d',
                'icon_color' => '#f472b6',
                'order' => 5,
            ],
            [
                'title' => 'Categoria 6',
                'icon_type' => 'svg',
                'icon_content' => '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 12h20"/><path d="M12 2v20"/></svg>',
                'stroke_color' => '#2563eb',
                'icon_color' => '#60a5fa',
                'order' => 6,
            ],
            [
                'title' => 'Categoria 7',
                'icon_type' => 'svg',
                'icon_content' => '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="8" width="16" height="8" rx="4"/></svg>',
                'stroke_color' => '#7c3aed',
                'icon_color' => '#a78bfa',
                'order' => 7,
            ],
            [
                'title' => 'Categoria 8',
                'icon_type' => 'svg',
                'icon_content' => '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/></svg>',
                'stroke_color' => '#f43f5e',
                'icon_color' => '#f87171',
                'order' => 8,
            ],
            [
                'title' => 'Categoria 9',
                'icon_type' => 'svg',
                'icon_content' => '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="8" y="8" width="8" height="8" rx="4"/></svg>',
                'stroke_color' => '#0ea5e9',
                'icon_color' => '#38bdf8',
                'order' => 9,
            ],
            [
                'title' => 'Categoria 10',
                'icon_type' => 'svg',
                'icon_content' => '<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="4,4 20,12 4,20"/></svg>',
                'stroke_color' => '#f59e42',
                'icon_color' => '#fbbf24',
                'order' => 10,
            ],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
} 