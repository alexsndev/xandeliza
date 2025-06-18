<?php

namespace Database\Seeders;

use App\Models\SiteConfig;
use Illuminate\Database\Seeder;

class SiteLogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica se a configuração já existe
        $existingConfig = SiteConfig::where('key', 'site_logo')->first();
        
        if (!$existingConfig) {
            // Adiciona a configuração do logo
            SiteConfig::create([
                'key' => 'site_logo',
                'value' => '',
                'type' => 'image',
                'group' => 'general',
                'label' => 'Logo do Site (deixe em branco para usar texto)',
                'order' => 3
            ]);
            
            $this->command->info('Configuração do logo adicionada com sucesso!');
        } else {
            $this->command->info('Configuração do logo já existe.');
        }
    }
}
