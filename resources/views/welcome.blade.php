<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $configs['site_title'] ?? 'Alexandre & Liza - Soluções Digitais' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=montserrat:400,500,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .nav-link-custom {
                color: {{ $configs['nav_item_color'] ?? '#ffffff' }} !important;
                transition: color 0.2s, background 0.2s;
            }
            .nav-link-custom:hover {
                color: #fff !important;
                background: {{ $configs['nav_item_hover_color'] ?? '#111827' }} !important;
            }
            .btn-primary {
                background: {{ $configs['primary_button_color'] ?? '#111827' }} !important;
                color: #fff !important;
                border: none;
                transition: background 0.2s;
            }
            .btn-primary:hover {
                filter: brightness(0.9);
            }
        </style>
    </head>
    <body class="bg-gray-100">
        @if(auth()->check() && auth()->user()->role === 'admin')
            <div style="background: #222; color: #fff; padding: 8px 16px; font-size: 14px; z-index:9999;">
                <b>DEBUG VISUAL (configs show_*):</b>
                @foreach($configs as $k => $v)
                    @if(Str::startsWith($k, 'show_'))
                        <span style="margin-right: 12px;">{{ $k }}: <b>{{ $v }}</b></span>
                    @endif
                @endforeach
            </div>
        @endif
        <!-- Header/Nav -->
        <header class="text-white fixed w-full top-0 z-50 shadow-lg" style="background-color: {{ $configs['public_header_color'] ?? '#111827' }}">
            <div class="container mx-auto px-4 py-3 flex items-center justify-between min-h-16">
                <div class="flex items-center gap-4">
                    <div class="logo">
                        @if(!empty($configs['site_logo']))
                            <x-edit-overlay section="general" configKey="site_logo">
                                <img src="{{ $configs['site_logo'] }}" alt="{{ $configs['site_title'] ?? 'Alexandre & Liza' }}" class="h-12 w-auto">
                            </x-edit-overlay>
                        @else
                            <x-edit-overlay section="general" configKey="site_title">
                                <span class="font-bold text-2xl tracking-wide">{{ $configs['site_title'] ?? 'Alexandre & Liza' }}</span>
                            </x-edit-overlay>
                        @endif
                    </div>
                </div>
                <!-- Desktop nav -->
                <nav class="hidden md:flex">
                    <ul class="flex flex-row gap-8 text-lg font-semibold">
                        <li><a href="#home" class="px-3 py-1 rounded nav-link-custom">Início</a></li>
                        <li><a href="#services" class="px-3 py-1 rounded nav-link-custom">Serviços</a></li>
                        <li><a href="#packages" class="px-3 py-1 rounded nav-link-custom">Pacotes</a></li>
                        <li><a href="#about" class="px-3 py-1 rounded nav-link-custom">Sobre Nós</a></li>
                        <li><a href="#contact" class="px-3 py-1 rounded nav-link-custom">Contato</a></li>
                        @if (Route::has('login'))
                            @auth
                                <li><a href="{{ url('/dashboard') }}" class="px-3 py-1 rounded nav-link-custom">Dashboard</a></li>
                                @if(auth()->user()->role === 'admin')
                                    <li>
                                        <div class="relative group inline-block">
                                            <button class="flex items-center gap-2 px-3 py-1 rounded hover:bg-neutral-800 transition-colors text-xs" id="colorDropdownBtn">
                                                <i class="fas fa-palette"></i> Cores do Site <i class="fas fa-caret-down"></i>
                                            </button>
                                            <div class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded shadow-lg p-4 z-50 hidden group-hover:block" id="colorDropdownMenu" style="color: #222;">
                                                <div class="flex flex-col gap-3">
                                                    <div class="flex items-center gap-2">
                                                        <input type="color"
                                                               id="headerColorPicker"
                                                               value="{{ $configs['public_header_color'] ?? '#111827' }}"
                                                               onchange="updateHeaderColor(this.value, 'general', 'public_header_color')">
                                                        <span class="text-sm text-gray-800">Header</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <input type="color"
                                                               id="navItemColorPicker"
                                                               value="{{ $configs['nav_item_color'] ?? '#ffffff' }}"
                                                               onchange="updateNavColor(this.value, 'nav_item_color')">
                                                        <span class="text-sm text-gray-800">Menu</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <input type="color"
                                                               id="navItemHoverColorPicker"
                                                               value="{{ $configs['nav_item_hover_color'] ?? '#111827' }}"
                                                               onchange="updateNavColor(this.value, 'nav_item_hover_color')">
                                                        <span class="text-sm text-gray-800">Hover</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <input type="color"
                                                               id="primaryButtonColorPicker"
                                                               value="{{ $configs['primary_button_color'] ?? '#111827' }}"
                                                               onchange="updateNavColor(this.value, 'primary_button_color')">
                                                        <span class="text-sm text-gray-800">Botão</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="relative group inline-block">
                                            <button class="flex items-center gap-2 px-3 py-1 rounded hover:bg-neutral-800 transition-colors text-xs" id="sectionToggleBtn">
                                                <i class="fas fa-cog"></i> <span class="hidden md:inline">Seções do Site</span> <i class="fas fa-caret-down"></i>
                                            </button>
                                            <div class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded shadow-lg p-4 z-50 hidden group-hover:block" id="sectionToggleMenu" style="color: #222; min-width: 220px;">
                                                <div class="flex flex-col gap-3">
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="checkbox" class="section-switch" data-key="show_hero" @if(!empty($configs['show_hero']) && $configs['show_hero']=='1') checked @endif>
                                                        <span>Hero</span>
                                                    </label>
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="checkbox" class="section-switch" data-key="show_banners" @if(!empty($configs['show_banners']) && $configs['show_banners']=='1') checked @endif>
                                                        <span>Banner</span>
                                                    </label>
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="checkbox" class="section-switch" data-key="show_galleries" @if(!empty($configs['show_galleries']) && $configs['show_galleries']=='1') checked @endif>
                                                        <span>Galeria</span>
                                                    </label>
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="checkbox" class="section-switch" data-key="show_experiences" @if(!empty($configs['show_experiences']) && $configs['show_experiences']=='1') checked @endif>
                                                        <span>Experiências</span>
                                                    </label>
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="checkbox" class="section-switch" data-key="show_products" @if(!empty($configs['show_products']) && $configs['show_products']=='1') checked @endif>
                                                        <span>Produtos</span>
                                                    </label>
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="checkbox" class="section-switch" data-key="show_packages" @if(!empty($configs['show_packages']) && $configs['show_packages']=='1') checked @endif>
                                                        <span>Pacotes</span>
                                                    </label>
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="checkbox" class="section-switch" data-key="show_about" @if(!empty($configs['show_about']) && $configs['show_about']=='1') checked @endif>
                                                        <span>Sobre</span>
                                                    </label>
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="checkbox" class="section-switch" data-key="show_contact" @if(!empty($configs['show_contact']) && $configs['show_contact']=='1') checked @endif>
                                                        <span>Contato</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @else
                                <li><a href="{{ route('login') }}" class="px-3 py-1 rounded hover:bg-neutral-800 transition-colors">Conecte-se</a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}" class="px-3 py-1 rounded hover:bg-neutral-800 transition-colors">Cadastro</a></li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </nav>
                <!-- Mobile nav toggle -->
                <button id="menu-toggle" class="md:hidden text-2xl ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <!-- Mobile nav -->
            <nav id="mobile-nav" class="md:hidden hidden bg-neutral-900 px-4 pb-4 shadow-lg">
                <ul class="flex flex-col gap-2 text-lg font-semibold">
                    <li><a href="#home" class="px-3 py-2 rounded hover:bg-neutral-800 transition-colors">Início</a></li>
                    <li><a href="#services" class="px-3 py-2 rounded hover:bg-neutral-800 transition-colors">Serviços</a></li>
                    <li><a href="#packages" class="px-3 py-2 rounded hover:bg-neutral-800 transition-colors">Pacotes</a></li>
                    <li><a href="#about" class="px-3 py-2 rounded hover:bg-neutral-800 transition-colors">Sobre Nós</a></li>
                    <li><a href="#contact" class="px-3 py-2 rounded hover:bg-neutral-800 transition-colors">Contato</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li><a href="{{ url('/dashboard') }}" class="px-3 py-2 rounded hover:bg-neutral-800 transition-colors">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="px-3 py-2 rounded hover:bg-neutral-800 transition-colors">Conecte-se</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}" class="px-3 py-2 rounded hover:bg-neutral-800 transition-colors">Cadastro</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </nav>
        </header>

        @if(isset($banners) && $banners->count() > 0)
            <div class="banner-section">
                <x-banner-slider :banners="$banners" />
            </div>
        @endif
        <x-category-carousel />
        
        <main class="pt-24">
            <section id="home" class="text-center py-20 bg-white">
                <div class="container mx-auto">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        <x-edit-overlay section="hero" configKey="hero_title">
                            {{ $configs['hero_title'] ?? 'Transforme sua presença digital' }}
                        </x-edit-overlay>
                    </h1>
                    <p class="text-lg md:text-xl mb-8">
                        <x-edit-overlay section="hero" configKey="hero_subtitle">
                            {{ $configs['hero_subtitle'] ?? 'Soluções completas em marketing digital, desenvolvimento web e design para impulsionar seu negócio.' }}
                        </x-edit-overlay>
                    </p>
                    @php
                        $buttonColor = $configs['primary_button_color'] ?? '#111827';
                    @endphp
                    <a href="#contact" class="inline-flex items-center mt-6 text-white px-8 py-3 rounded font-semibold transition group relative" id="heroButton" style="background: {{ $buttonColor }};">
                        <x-edit-overlay section="hero" configKey="hero_cta_text">
                            {{ $configs['hero_cta_text'] ?? 'Fale Conosco' }}
                        </x-edit-overlay>
                    </a>
                </div>
            </section>
            <!-- Serviços -->
            <section id="services" class="py-20 bg-gray-50">
                <div class="container mx-auto">
                    <h2 class="text-3xl font-bold text-center mb-12">
                        <x-edit-overlay section="services" configKey="services_title">
                            {{ $configs['services_title'] ?? 'Nossos Serviços' }}
                        </x-edit-overlay>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="bg-white rounded-lg shadow p-6 text-center">
                                <div class="mb-4 flex justify-center items-center">
                                    <x-edit-overlay section="services" configKey="service_{{$i}}_icon">
                                        @php $icon = $configs['service_'.$i.'_icon'] ?? ($i == 1 ? 'fas fa-ad' : ($i == 2 ? 'fab fa-wordpress' : ($i == 3 ? 'fas fa-code' : 'fas fa-paint-brush'))); @endphp
                                        @if(Str::endsWith($icon, ['.png', '.jpg', '.jpeg', '.svg', '.gif', '.webp']))
                                            <img src="{{ $icon }}" alt="Ícone" class="w-12 h-12 object-contain">
                                        @else
                                            <i class="{{ $icon }} text-4xl"></i>
                                        @endif
                                    </x-edit-overlay>
                                </div>
                                <h3 class="font-semibold text-xl mb-2">
                                    <x-edit-overlay section="services" configKey="service_{{$i}}_title">
                                        {{ $configs['service_'.$i.'_title'] ?? ['Tráfego Pago','WordPress','Programação','Design Gráfico'][$i-1] }}
                                    </x-edit-overlay>
                                </h3>
                                <p class="text-gray-600">
                                    <x-edit-overlay section="services" configKey="service_{{$i}}_description">
                                        {{ $configs['service_'.$i.'_description'] ?? [
                                            'Aumente sua visibilidade online e alcance seu público-alvo com estratégias eficientes de tráfego pago.',
                                            'Desenvolvimento e gestão de sites WordPress personalizados para o seu negócio.',
                                            'Desenvolvimento de sistemas web, aplicativos e soluções digitais personalizadas.',
                                            'Criação de identidade visual, logotipos, materiais gráficos e peças para redes sociais.'
                                        ][$i-1] }}
                                    </x-edit-overlay>
                                </p>
                            </div>
                        @endfor
                    </div>
                </div>
            </section>
            @if (!empty($configs['show_products']) && $configs['show_products'] == '1')
                @include('components.products-section', ['productCategories' => $productCategories, 'products' => $products])
            @endif
            {{-- Experiências --}}
            @if (!empty($configs['show_experiences']) && $configs['show_experiences'] == '1')
                @include('components.experiences-section', ['experiences' => $experiences])
            @endif
            {{-- Galeria --}}
            @if (!empty($configs['show_galleries']) && $configs['show_galleries'] == '1')
                @include('components.galleries-section', ['galleries' => $galleries])
            @endif
            <!-- Pacotes -->
            <section id="packages" class="py-20 bg-white">
                <div class="container mx-auto">
                    <h2 class="text-3xl font-bold text-center mb-12">
                        <x-edit-overlay section="packages" configKey="packages_title">
                            {{ $configs['packages_title'] ?? 'Nossos Pacotes' }}
                        </x-edit-overlay>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <x-package-card :package="$packages['essential']" type="essential" :configs="$configs" />
                        <x-package-card :package="$packages['professional']" type="popular" :configs="$configs" />
                        <x-package-card :package="$packages['enterprise']" type="enterprise" :configs="$configs" />
                    </div>
                </div>
            </section>
            <!-- Sobre -->
            <section id="about" class="py-20 bg-gray-50">
                <div class="container mx-auto">
                    <h2 class="text-3xl font-bold text-center mb-12">
                        <x-edit-overlay section="about" configKey="about_title">
                            {{ $configs['about_title'] ?? 'Sobre Nós' }}
                        </x-edit-overlay>
                    </h2>
                    <div class="flex flex-col md:flex-row items-center gap-12">
                        <div class="flex-1">
                            <p class="mb-4">
                                <x-edit-overlay section="about" configKey="about_text">
                                    {{ $configs['about_text'] ?? 'Somos uma agência digital apaixonada por criar soluções inovadoras que impulsionam o crescimento dos nossos clientes.' }}
                                </x-edit-overlay>
                            </p>
                            <p>
                                <x-edit-overlay section="about" configKey="about_text_2">
                                    {{ $configs['about_text_2'] ?? 'Nossa missão é ajudar empresas a alcançarem seu potencial máximo no ambiente digital.' }}
                                </x-edit-overlay>
                            </p>
                        </div>
                        <div class="flex-1 flex gap-4 justify-center">
                            <x-edit-overlay section="about" configKey="about_image_1">
                                <img src="{{ $configs['about_image_1'] ?? 'https://via.placeholder.com/300x300' }}" alt="Alexandre" class="rounded-lg w-40 h-40 object-cover">
                            </x-edit-overlay>
                            <x-edit-overlay section="about" configKey="about_image_2">
                                <img src="{{ $configs['about_image_2'] ?? 'https://via.placeholder.com/300x300' }}" alt="Liza" class="rounded-lg w-40 h-40 object-cover">
                            </x-edit-overlay>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Contato -->
            <section id="contact" class="py-20 bg-white">
                <div class="container mx-auto max-w-xl">
                    <h2 class="text-3xl font-bold text-center mb-8">
                        <x-edit-overlay section="contact" configKey="contact_title">
                            {{ $configs['contact_title'] ?? 'Entre em Contato' }}
                        </x-edit-overlay>
                    </h2>
                    @if(session('success'))
                        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-center font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif
                    @php
                        $buttonColor = $configs['primary_button_color'] ?? '#111827';
                    @endphp
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block mb-1 font-medium">Nome</label>
                            <input type="text" id="name" name="name" required class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label for="email" class="block mb-1 font-medium">Email</label>
                            <input type="email" id="email" name="email" required class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label for="message" class="block mb-1 font-medium">Mensagem</label>
                            <textarea id="message" name="message" required class="w-full border rounded px-3 py-2"></textarea>
                        </div>
                        <button type="submit" class="px-6 py-2 rounded font-semibold w-full" style="background: {{ $buttonColor }}; color: #fff;">Enviar Mensagem</button>
                    </form>
                </div>
            </section>
            <!-- Footer -->
            <footer class="bg-neutral-900 text-white py-8 mt-12">
                <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex gap-4 text-2xl">
                        @if(!empty($configs['facebook_url']))
                            <a href="{{ $configs['facebook_url'] }}" target="_blank"><i class="fab fa-facebook"></i></a>
                        @endif
                        @if(!empty($configs['instagram_url']))
                            <a href="{{ $configs['instagram_url'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(!empty($configs['linkedin_url']))
                            <a href="{{ $configs['linkedin_url'] }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                        @endif
                        @if(!empty($configs['whatsapp_url']))
                            <a href="{{ $configs['whatsapp_url'] }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        @endif
                    </div>
                    <p class="text-center md:text-right">
                        <x-edit-overlay section="general" configKey="site_title">
                            &copy; {{ date('Y') }} {{ $configs['site_title'] ?? 'Alexandre & Liza' }}. Todos os direitos reservados.
                        </x-edit-overlay>
                    </p>
                </div>
            </footer>
        </main>
        @stack('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const menuToggle = document.getElementById('menu-toggle');
                const mobileNav = document.getElementById('mobile-nav');
                if (menuToggle && mobileNav) {
                    menuToggle.addEventListener('click', function() {
                        mobileNav.classList.toggle('hidden');
                    });
                    mobileNav.querySelectorAll('a').forEach(link => {
                        link.addEventListener('click', () => {
                            mobileNav.classList.add('hidden');
                        });
                    });
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editButtons = document.querySelectorAll('.edit-button');
                editButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const section = this.dataset.section;
                        const key = this.dataset.key;
                        const element = this.closest('.group');
                        const currentValue = element.querySelector('img')?.src || element.textContent.trim();
                        // Sempre mostrar campo de upload e campo de texto para logo e ícones
                        const isIconOrLogo = key.endsWith('_icon') || key === 'site_logo';
                        let modalContent = '';
                        if (isIconOrLogo) {
                            modalContent = `
                                <div class='mb-4'>
                                    <label class='block mb-1 font-medium'>Classe do Ícone (FontAwesome) ou URL da Imagem</label>
                                    <input type='text' class='w-full border rounded px-2 py-1 mb-2' value='${!element.querySelector('img') ? currentValue : ''}'>
                                    <label class='block mb-1 font-medium mt-2'>Ou selecione uma imagem (PNG, SVG, JPG...)</label>
                                    <input type='file' class='w-full' accept='image/*'>
                                    ${element.querySelector('img') ? `<img src='${currentValue}' class='w-20 h-20 object-contain mt-2 mx-auto'>` : ''}
                                </div>
                            `;
                        } else {
                            modalContent = element.querySelector('img') ? `
                                <div class='mb-4'>
                                    <img src='${currentValue}' class='w-full h-48 object-contain mb-2'>
                                    <input type='file' class='w-full' accept='image/*'>
                                </div>
                            ` : `
                                <textarea class='w-full h-32 p-2 border rounded mb-4'>${currentValue}</textarea>
                            `;
                        }
                        const modal = document.createElement('div');
                        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                        modal.innerHTML = `
                            <div class='bg-white rounded-lg p-6 w-96'>
                                <h3 class='text-lg font-semibold mb-4'>Editar ${key}</h3>
                                ${modalContent}
                                <div class='flex justify-end gap-2 mt-4'>
                                    <button class='px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 cancel-edit'>Cancelar</button>
                                    <button class='px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 save-edit'>Salvar</button>
                                </div>
                            </div>
                        `;
                        document.body.appendChild(modal);
                        // Fechar modal
                        modal.querySelector('.cancel-edit').addEventListener('click', () => {
                            modal.remove();
                        });
                        // Salvar alterações
                        modal.querySelector('.save-edit').addEventListener('click', async () => {
                            const formData = new FormData();
                            formData.append('_token', '{{ csrf_token() }}');
                            const fileInput = modal.querySelector('input[type="file"]');
                            const classInput = modal.querySelector('input[type="text"]');
                            const textarea = modal.querySelector('textarea');
                            if (fileInput && fileInput.files.length > 0) {
                                formData.append(key, fileInput.files[0]);
                            } else if (classInput) {
                                formData.append(key, classInput.value);
                            } else if (textarea) {
                                formData.append(key, textarea.value);
                            }
                            try {
                                const response = await fetch(`/admin/site-config/${section}`, {
                                    method: 'POST',
                                    body: formData
                                });
                                if (response.ok) {
                                    window.location.reload();
                                } else {
                                    alert('Erro ao salvar alterações');
                                }
                            } catch (error) {
                                console.error('Erro:', error);
                                alert('Erro ao salvar alterações');
                            }
                            modal.remove();
                        });
                    });
                });
            });
        </script>
        <script>
            async function updateHeaderColor(color, section, key) {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append(key, color);
                
                try {
                    const response = await fetch(`/admin/site-config/${section}`, {
                        method: 'POST',
                        body: formData
                    });
                    
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        alert('Erro ao salvar alterações');
                    }
                } catch (error) {
                    console.error('Erro:', error);
                    alert('Erro ao salvar alterações');
                }
            }
        </script>
        <script>
            async function updateButtonColor(color) {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('hero_button_color', color);
                
                try {
                    const response = await fetch('/admin/site-config/hero', {
                        method: 'POST',
                        body: formData
                    });
                    
                    if (response.ok) {
                        const button = document.getElementById('heroButton');
                        if (button) {
                            button.style.backgroundColor = color;
                        }
                        window.location.reload();
                    } else {
                        alert('Erro ao salvar alterações');
                    }
                } catch (error) {
                    console.error('Erro:', error);
                    alert('Erro ao salvar alterações');
                }
            }
        </script>
        <script>
            async function updateNavColor(color, key) {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append(key, color);
                try {
                    const response = await fetch('/admin/site-config/general', {
                        method: 'POST',
                        body: formData
                    });
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        alert('Erro ao salvar cor do menu');
                    }
                } catch (error) {
                    alert('Erro ao salvar cor do menu');
                }
            }
        </script>
        <script>
            // Dropdown de cores para admin
            const colorDropdownBtn = document.getElementById('colorDropdownBtn');
            const colorDropdownMenu = document.getElementById('colorDropdownMenu');
            if (colorDropdownBtn && colorDropdownMenu) {
                colorDropdownBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    colorDropdownMenu.classList.toggle('hidden');
                });
                document.addEventListener('click', function(e) {
                    if (!colorDropdownMenu.contains(e.target) && e.target !== colorDropdownBtn) {
                        colorDropdownMenu.classList.add('hidden');
                    }
                });
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ... já existente ...
                // Dropdown de seções
                const sectionToggleBtn = document.getElementById('sectionToggleBtn');
                const sectionToggleMenu = document.getElementById('sectionToggleMenu');
                if(sectionToggleBtn && sectionToggleMenu) {
                    sectionToggleBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        sectionToggleMenu.classList.toggle('hidden');
                    });
                    document.addEventListener('click', function(e) {
                        if (!sectionToggleMenu.contains(e.target) && !sectionToggleBtn.contains(e.target)) {
                            sectionToggleMenu.classList.add('hidden');
                        }
                    });
                }
                document.querySelectorAll('.section-switch').forEach(function(switchEl) {
                    switchEl.addEventListener('change', function() {
                        const key = this.dataset.key;
                        const value = this.checked ? '1' : '0';
                        fetch('/api/site-config/toggle-section', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ key, value })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if(data.success) {
                                // Opcional: feedback visual
                            }
                        });
                    });
                });
            });
        </script>
    </body>
</html>
