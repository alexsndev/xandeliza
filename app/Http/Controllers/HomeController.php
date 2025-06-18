<?php

namespace App\Http\Controllers;

use App\Models\SiteConfig;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Exibe a página inicial do site
     */
    public function index()
    {
        $configs = SiteConfig::pluck('value', 'key')->toArray();
        $banners = Banner::where('is_active', true)->orderBy('order')->get();
        
        $packages = [
            'essential' => [
                'name' => 'Pacote Essencial',
                'price' => 1490,
                'features' => [
                    'Até 5 páginas',
                    'Design responsivo',
                    'Formulário de contato',
                    'SEO básico',
                    'Suporte por email'
                ]
            ],
            'professional' => [
                'name' => 'Pacote Profissional',
                'price' => 2990,
                'features' => [
                    'Até 10 páginas',
                    'Design responsivo',
                    'Formulário de contato',
                    'SEO avançado',
                    'Integração com redes sociais',
                    'Suporte prioritário'
                ]
            ],
            'enterprise' => [
                'name' => 'Pacote Enterprise',
                'price' => 4990,
                'features' => [
                    'Páginas ilimitadas',
                    'Design responsivo',
                    'Formulário de contato',
                    'SEO avançado',
                    'Integração com redes sociais',
                    'E-commerce completo',
                    'Suporte 24/7'
                ]
            ]
        ];
        
        return view('welcome', compact('configs', 'packages', 'banners'));
    }
}
