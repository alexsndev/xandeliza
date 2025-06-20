<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SiteConfig;

class AddCategoryNavColorsToSiteConfigs extends Migration
{
    public function up()
    {
        // Adiciona a configuração de cor de fundo dos botões de navegação
        SiteConfig::create([
            'key' => 'category_nav_bg_color',
            'value' => '#e5e7eb',
            'type' => 'color',
            'section' => 'general',
            'label' => 'Cor do Fundo dos Botões de Navegação',
            'order' => 120
        ]);

        // Adiciona a configuração de cor dos ícones dos botões de navegação
        SiteConfig::create([
            'key' => 'category_nav_icon_color',
            'value' => '#4b5563',
            'type' => 'color',
            'section' => 'general',
            'label' => 'Cor do Ícone dos Botões de Navegação',
            'order' => 121
        ]);
    }

    public function down()
    {
        SiteConfig::where('key', 'category_nav_bg_color')->delete();
        SiteConfig::where('key', 'category_nav_icon_color')->delete();
    }
} 