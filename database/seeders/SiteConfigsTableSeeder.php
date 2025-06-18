<?php

namespace Database\Seeders;

use App\Models\SiteConfig;
use Illuminate\Database\Seeder;

class SiteConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa todas as configurações existentes
        SiteConfig::truncate();

        // Configurações gerais
        SiteConfig::create([
            'key' => 'site_title',
            'value' => 'Alexandre & Liza - Soluções Digitais',
            'type' => 'text',
            'section' => 'general',
            'label' => 'Título do Site',
            'order' => 1
        ]);

        SiteConfig::create([
            'key' => 'public_header_color',
            'value' => '#111827',
            'type' => 'color',
            'section' => 'general',
            'label' => 'Cor do Header',
            'order' => 2
        ]);

        SiteConfig::create([
            'key' => 'site_description',
            'value' => 'Especialistas em tráfego pago, desenvolvimento e gestão de sites WordPress, programação e design gráfico.',
            'type' => 'textarea',
            'section' => 'general',
            'label' => 'Descrição do Site',
            'order' => 3
        ]);
        
        SiteConfig::create([
            'key' => 'site_logo',
            'value' => '',
            'type' => 'image',
            'section' => 'general',
            'label' => 'Logo do Site (deixe em branco para usar texto)',
            'order' => 4
        ]);

        SiteConfig::create([
            'key' => 'nav_item_color',
            'value' => '#ffffff',
            'type' => 'color',
            'section' => 'general',
            'label' => 'Cor dos Itens do Menu',
            'order' => 5
        ]);

        SiteConfig::create([
            'key' => 'nav_item_hover_color',
            'value' => '#111827',
            'type' => 'color',
            'section' => 'general',
            'label' => 'Cor do Hover dos Itens do Menu',
            'order' => 6
        ]);

        SiteConfig::create([
            'key' => 'primary_button_color',
            'value' => '#111827',
            'type' => 'color',
            'section' => 'general',
            'label' => 'Cor dos Botões (Primário)',
            'order' => 7
        ]);

        // Seção Hero
        SiteConfig::create([
            'key' => 'hero_title',
            'value' => 'Transforme sua presença digital',
            'type' => 'text',
            'section' => 'hero',
            'label' => 'Título da Seção Hero',
            'order' => 1
        ]);

        SiteConfig::create([
            'key' => 'hero_subtitle',
            'value' => 'Soluções completas em marketing digital, desenvolvimento web e design para impulsionar seu negócio.',
            'type' => 'textarea',
            'section' => 'hero',
            'label' => 'Subtítulo da Seção Hero',
            'order' => 2
        ]);

        SiteConfig::create([
            'key' => 'hero_button_color',
            'value' => '#111827',
            'type' => 'color',
            'section' => 'hero',
            'label' => 'Cor do Botão Hero',
            'order' => 3
        ]);

        SiteConfig::create([
            'key' => 'hero_cta_text',
            'value' => 'Fale Conosco',
            'type' => 'text',
            'section' => 'hero',
            'label' => 'Texto do Botão Hero',
            'order' => 4
        ]);

        SiteConfig::create([
            'key' => 'hero_background',
            'value' => 'https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
            'type' => 'image',
            'section' => 'hero',
            'label' => 'Imagem de Fundo da Seção Hero',
            'order' => 5
        ]);

        // Serviços
        SiteConfig::create([
            'key' => 'services_title',
            'value' => 'Nossos Serviços',
            'type' => 'text',
            'section' => 'services',
            'label' => 'Título da Seção de Serviços',
            'order' => 1
        ]);

        SiteConfig::create([
            'key' => 'services_subtitle',
            'value' => 'Oferecemos soluções completas para sua presença digital',
            'type' => 'textarea',
            'section' => 'services',
            'label' => 'Subtítulo da Seção de Serviços',
            'order' => 2
        ]);

        // Serviço 1
        SiteConfig::create([
            'key' => 'service_1_title',
            'value' => 'Tráfego Pago',
            'type' => 'text',
            'section' => 'services',
            'label' => 'Título do Serviço 1',
            'order' => 2
        ]);

        SiteConfig::create([
            'key' => 'service_1_description',
            'value' => 'Aumente sua visibilidade online e alcance seu público-alvo com estratégias eficientes de tráfego pago. Gerenciamos campanhas no Google Ads, Facebook Ads e Instagram Ads.',
            'type' => 'textarea',
            'section' => 'services',
            'label' => 'Descrição do Serviço 1',
            'order' => 3
        ]);

        SiteConfig::create([
            'key' => 'service_1_icon',
            'value' => 'fas fa-ad',
            'type' => 'text',
            'section' => 'services',
            'label' => 'Ícone do Serviço 1',
            'order' => 4
        ]);

        // Serviço 2
        SiteConfig::create([
            'key' => 'service_2_title',
            'value' => 'WordPress',
            'type' => 'text',
            'section' => 'services',
            'label' => 'Título do Serviço 2',
            'order' => 5
        ]);

        SiteConfig::create([
            'key' => 'service_2_description',
            'value' => 'Desenvolvimento e gestão de sites WordPress personalizados para o seu negócio. Criamos sites responsivos, otimizados e fáceis de gerenciar.',
            'type' => 'textarea',
            'section' => 'services',
            'label' => 'Descrição do Serviço 2',
            'order' => 6
        ]);

        SiteConfig::create([
            'key' => 'service_2_icon',
            'value' => 'fab fa-wordpress',
            'type' => 'text',
            'section' => 'services',
            'label' => 'Ícone do Serviço 2',
            'order' => 7
        ]);

        // Serviço 3
        SiteConfig::create([
            'key' => 'service_3_title',
            'value' => 'Programação',
            'type' => 'text',
            'section' => 'services',
            'label' => 'Título do Serviço 3',
            'order' => 8
        ]);

        SiteConfig::create([
            'key' => 'service_3_description',
            'value' => 'Desenvolvimento de sistemas web, aplicativos e soluções digitais personalizadas para atender às necessidades específicas do seu negócio.',
            'type' => 'textarea',
            'section' => 'services',
            'label' => 'Descrição do Serviço 3',
            'order' => 9
        ]);

        SiteConfig::create([
            'key' => 'service_3_icon',
            'value' => 'fas fa-code',
            'type' => 'text',
            'section' => 'services',
            'label' => 'Ícone do Serviço 3',
            'order' => 10
        ]);

        // Serviço 4
        SiteConfig::create([
            'key' => 'service_4_title',
            'value' => 'Design Gráfico',
            'type' => 'text',
            'section' => 'services',
            'label' => 'Título do Serviço 4',
            'order' => 11
        ]);

        SiteConfig::create([
            'key' => 'service_4_description',
            'value' => 'Criação de identidade visual, logotipos, materiais gráficos e peças para redes sociais que comunicam a essência da sua marca.',
            'type' => 'textarea',
            'section' => 'services',
            'label' => 'Descrição do Serviço 4',
            'order' => 12
        ]);

        SiteConfig::create([
            'key' => 'service_4_icon',
            'value' => 'fas fa-paint-brush',
            'type' => 'text',
            'section' => 'services',
            'label' => 'Ícone do Serviço 4',
            'order' => 13
        ]);

        // Sobre Nós
        SiteConfig::create([
            'key' => 'about_title',
            'value' => 'Sobre Nós',
            'type' => 'text',
            'section' => 'about',
            'label' => 'Título da Seção Sobre Nós',
            'order' => 1
        ]);

        SiteConfig::create([
            'key' => 'about_content',
            'value' => 'Somos uma empresa especializada em soluções digitais, focada em entregar resultados excepcionais para nossos clientes.',
            'type' => 'textarea',
            'section' => 'about',
            'label' => 'Conteúdo da Seção Sobre Nós',
            'order' => 2
        ]);

        SiteConfig::create([
            'key' => 'about_image_1',
            'value' => 'https://via.placeholder.com/300x300',
            'type' => 'image',
            'section' => 'about',
            'label' => 'Imagem 1 da Seção Sobre Nós',
            'order' => 3
        ]);

        SiteConfig::create([
            'key' => 'about_image_2',
            'value' => 'https://via.placeholder.com/300x300',
            'type' => 'image',
            'section' => 'about',
            'label' => 'Imagem 2 da Seção Sobre Nós',
            'order' => 4
        ]);

        // Contato
        SiteConfig::create([
            'key' => 'contact_title',
            'value' => 'Entre em Contato',
            'type' => 'text',
            'section' => 'contact',
            'label' => 'Título da Seção de Contato',
            'order' => 1
        ]);

        SiteConfig::create([
            'key' => 'contact_email',
            'value' => 'contato@alexandreliza.com.br',
            'type' => 'text',
            'section' => 'contact',
            'label' => 'Email de Contato',
            'order' => 2
        ]);

        SiteConfig::create([
            'key' => 'contact_phone',
            'value' => '(11) 99999-9999',
            'type' => 'text',
            'section' => 'contact',
            'label' => 'Telefone de Contato',
            'order' => 3
        ]);

        // Redes Sociais
        SiteConfig::create([
            'key' => 'social_facebook',
            'value' => 'https://facebook.com/alexandreliza',
            'type' => 'text',
            'section' => 'social',
            'label' => 'Facebook',
            'order' => 1
        ]);

        SiteConfig::create([
            'key' => 'social_instagram',
            'value' => 'https://instagram.com/alexandreliza',
            'type' => 'text',
            'section' => 'social',
            'label' => 'Instagram',
            'order' => 2
        ]);

        SiteConfig::create([
            'key' => 'social_linkedin',
            'value' => 'https://linkedin.com/in/alexandreliza',
            'type' => 'text',
            'section' => 'social',
            'label' => 'LinkedIn',
            'order' => 3
        ]);

        SiteConfig::create([
            'key' => 'social_whatsapp',
            'value' => 'https://wa.me/5511999999999',
            'type' => 'text',
            'section' => 'social',
            'label' => 'WhatsApp',
            'order' => 4
        ]);

        SiteConfig::create([
            'key' => 'package_basic_button_color',
            'value' => '#111827',
            'type' => 'color',
            'section' => 'packages',
            'label' => 'Cor do Botão Pacote Essencial',
            'order' => 1
        ]);
        SiteConfig::create([
            'key' => 'package_pro_button_color',
            'value' => '#111827',
            'type' => 'color',
            'section' => 'packages',
            'label' => 'Cor do Botão Pacote Profissional',
            'order' => 2
        ]);
        SiteConfig::create([
            'key' => 'package_enterprise_button_color',
            'value' => '#111827',
            'type' => 'color',
            'section' => 'packages',
            'label' => 'Cor do Botão Pacote Enterprise',
            'order' => 3
        ]);
        SiteConfig::create([
            'key' => 'contact_button_color',
            'value' => '#111827',
            'type' => 'color',
            'section' => 'contact',
            'label' => 'Cor do Botão Enviar Mensagem',
            'order' => 4
        ]);
    }
}
