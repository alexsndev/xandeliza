<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configurações do Site') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="mb-6">
                        <p class="text-lg mb-4">Bem-vindo à área de configurações do site. Aqui você pode editar facilmente os textos, imagens e outras informações exibidas no site.</p>
                        <p class="text-gray-600">Selecione uma seção abaixo para começar a editar:</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Configurações Gerais -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                            <div class="p-5 bg-blue-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Configurações Gerais</h3>
                            </div>
                            <div class="p-5">
                                <p class="text-gray-600 mb-4">Edite as configurações básicas do site, como título e descrição.</p>
                    <a href="{{ route('admin.site-config.edit-section', 'general') }}" class="admin-button">
                                    <i class="fas fa-edit mr-2"></i> Editar
                                </a>
                            </div>
                        </div>

                        <!-- Seção Hero -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                            <div class="p-5 bg-blue-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Seção Principal (Hero)</h3>
                            </div>
                            <div class="p-5">
                                <p class="text-gray-600 mb-4">Edite o título, subtítulo, botão e imagem de fundo da seção principal.</p>
                                <a href="{{ route('admin.site-config.edit-section', 'hero') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Editar
                                </a>
                            </div>
                        </div>

                        <!-- Serviços -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                            <div class="p-5 bg-blue-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Serviços</h3>
                            </div>
                            <div class="p-5">
                                <p class="text-gray-600 mb-4">Edite os títulos, descrições e ícones dos serviços oferecidos.</p>
                                <a href="{{ route('admin.site-config.edit-section', 'services') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Editar
                                </a>
                            </div>
                        </div>

                        <!-- Sobre Nós -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                            <div class="p-5 bg-blue-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Sobre Nós</h3>
                            </div>
                            <div class="p-5">
                                <p class="text-gray-600 mb-4">Edite o título, descrição e imagens da seção Sobre Nós.</p>
                                <a href="{{ route('admin.site-config.edit-section', 'about') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Editar
                                </a>
                            </div>
                        </div>

                        <!-- Contato -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                            <div class="p-5 bg-blue-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Contato</h3>
                            </div>
                            <div class="p-5">
                                <p class="text-gray-600 mb-4">Edite o título e informações de contato.</p>
                                <a href="{{ route('admin.site-config.edit-section', 'contact') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Editar
                                </a>
                            </div>
                        </div>

                        <!-- Redes Sociais -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                            <div class="p-5 bg-blue-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Redes Sociais</h3>
                            </div>
                            <div class="p-5">
                                <p class="text-gray-600 mb-4">Edite os links para as redes sociais.</p>
                                <a href="{{ route('admin.site-config.edit-section', 'social') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Editar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
