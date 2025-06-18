<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Pacote 1 (Essencial)
        DB::table('site_configs')->insert([
            [
                'key' => 'package_1_title',
                'value' => 'Pacote Essencial',
                'label' => 'Título do Pacote 1',
                'type' => 'text',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'package_1_price',
                'value' => 'R$ 1.490',
                'label' => 'Preço do Pacote 1',
                'type' => 'text',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'package_1_features',
                'value' => "Site WordPress Básico - Até 5 páginas com design responsivo e otimizado para SEO\nGestão de Redes Sociais - 12 posts mensais para 2 plataformas\nTráfego Pago Básico - Gestão de campanhas com orçamento de até R$ 1.500\nRelatório Mensal - Acompanhamento de métricas e resultados\nSuporte por Email - Resposta em até 48 horas",
                'label' => 'Recursos do Pacote 1 (Uma linha por recurso)',
                'type' => 'textarea',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Pacote 2 (Profissional)
            [
                'key' => 'package_2_title',
                'value' => 'Pacote Profissional',
                'label' => 'Título do Pacote 2',
                'type' => 'text',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'package_2_price',
                'value' => 'R$ 2.990',
                'label' => 'Preço do Pacote 2',
                'type' => 'text',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'package_2_features',
                'value' => "Site WordPress Avançado - Até 10 páginas com design personalizado\nGestão de Redes Sociais - 20 posts mensais para 3 plataformas\nTráfego Pago Intermediário - Gestão de campanhas com orçamento de até R$ 3.000\nEmail Marketing - 2 campanhas mensais\nSEO Básico - Otimização para mecanismos de busca\nRelatório Quinzenal - Acompanhamento detalhado\nSuporte por Email e WhatsApp - Resposta em até 24 horas",
                'label' => 'Recursos do Pacote 2 (Uma linha por recurso)',
                'type' => 'textarea',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Pacote 3 (Enterprise)
            [
                'key' => 'package_3_title',
                'value' => 'Pacote Enterprise',
                'label' => 'Título do Pacote 3',
                'type' => 'text',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'package_3_price',
                'value' => 'R$ 4.990',
                'label' => 'Preço do Pacote 3',
                'type' => 'text',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'package_3_features',
                'value' => "Site WordPress Premium - Site completo com e-commerce e área de membros\nGestão de Redes Sociais - 30 posts mensais para 4 plataformas\nTráfego Pago Avançado - Gestão de campanhas com orçamento ilimitado\nEmail Marketing - 4 campanhas mensais com segmentação\nSEO Avançado - Estratégia completa de otimização\nCriação de Conteúdo - 4 artigos mensais para blog\nRelatório Semanal - Acompanhamento com reuniões\nSuporte Prioritário - Atendimento em até 4 horas",
                'label' => 'Recursos do Pacote 3 (Uma linha por recurso)',
                'type' => 'textarea',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Configurações gerais dos pacotes
            [
                'key' => 'packages_title',
                'value' => 'Nossos Pacotes',
                'label' => 'Título da Seção de Pacotes',
                'type' => 'text',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'packages_subtitle',
                'value' => 'Escolha o pacote que melhor se adapta às necessidades do seu negócio. Todos os nossos pacotes incluem suporte personalizado e resultados garantidos.',
                'label' => 'Subtítulo da Seção de Pacotes',
                'type' => 'textarea',
                'section' => 'packages',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        DB::table('site_configs')->where('section', 'packages')->delete();
    }
};
