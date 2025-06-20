<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SiteConfig;

class ShowSiteConfig extends Command
{
    protected $signature = 'siteconfig:show {key}';
    protected $description = 'Exibe o valor de uma configuração do site pelo key';

    public function handle()
    {
        $key = $this->argument('key');
        $config = SiteConfig::where('key', $key)->first();
        if ($config) {
            $this->info($key . ': ' . $config->value);
        } else {
            $this->error('Configuração não encontrada: ' . $key);
        }
    }
} 