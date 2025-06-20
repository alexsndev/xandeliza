<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\SiteConfig;

class AddSectionVisibilityToSiteConfigs extends Migration
{
    public function up()
    {
        $sections = [
            ['key' => 'show_hero', 'label' => 'Exibir Hero'],
            ['key' => 'show_banner', 'label' => 'Exibir Banner'],
            ['key' => 'show_categories', 'label' => 'Exibir Categorias'],
            ['key' => 'show_galleries', 'label' => 'Exibir Galeria'],
            ['key' => 'show_experiences', 'label' => 'Exibir Experiências'],
            ['key' => 'show_packages', 'label' => 'Exibir Pacotes'],
            ['key' => 'show_about', 'label' => 'Exibir Sobre'],
            ['key' => 'show_contact', 'label' => 'Exibir Contato'],
        ];
        foreach ($sections as $i => $section) {
            SiteConfig::create([
                'key' => $section['key'],
                'value' => '1',
                'type' => 'boolean',
                'section' => 'general',
                'label' => $section['label'],
                'order' => 200 + $i
            ]);
        }
    }
    public function down()
    {
        $keys = [
            'show_hero',
            'show_banner',
            'show_categories',
            'show_galleries',
            'show_experiences',
            'show_packages',
            'show_about',
            'show_contact',
        ];
        foreach ($keys as $key) {
            SiteConfig::where('key', $key)->delete();
        }
    }
} 