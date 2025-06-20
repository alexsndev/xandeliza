<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\SiteConfig;

class AddShowProductsToSiteConfigs extends Migration
{
    public function up()
    {
        if (!SiteConfig::where('key', 'show_products')->exists()) {
            SiteConfig::create([
                'key' => 'show_products',
                'value' => '1',
                'type' => 'boolean',
                'section' => 'general',
                'label' => 'Exibir Produtos',
                'order' => 210
            ]);
        }
    }
    public function down()
    {
        SiteConfig::where('key', 'show_products')->delete();
    }
} 