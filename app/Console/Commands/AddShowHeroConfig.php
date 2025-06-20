<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SiteConfig;

class AddShowHeroConfig extends Command
{
    protected $signature = 'siteconfig:add-show-hero';
    protected $description = 'Adiciona a configuração show_hero no banco de dados';

    public function handle()
    {
        $exists = SiteConfig::where('key', 'show_hero')->exists();
        if ($exists) {
            $this->info('A configuração show_hero já existe.');
            return;
        }
        SiteConfig::create([
            'key' => 'show_hero',
            'value' => '1',
            'type' => 'boolean',
            'section' => 'general',
            'label' => 'Exibir Hero',
            'order' => 199
        ]);
        $this->info('Configuração show_hero criada com sucesso!');
    }
} 