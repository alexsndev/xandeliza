<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $sectionTitle }}
            </h2>            <a href="{{ route('admin.site-config.index') }}" class="admin-button secondary">
                <i class="fas fa-arrow-left mr-2"></i> Voltar
            </a>
        </div>
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

                    <form action="{{ route('admin.site-config.update-section', $section) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="space-y-6">
                            @foreach ($configs as $config)
                                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                    <label for="{{ $config->key }}" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ $config->label }}
                                    </label>
                                      @if ($config->type === 'text')
                                        <input type="text" name="{{ $config->key }}" id="{{ $config->key }}" value="{{ $config->value }}" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @elseif ($config->type === 'textarea')
                                        <textarea name="{{ $config->key }}" id="{{ $config->key }}" rows="4" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $config->value }}</textarea>
                                    @elseif ($config->type === 'color')
                                        <div class="mt-1 flex items-center space-x-3">
                                            <input type="color" name="{{ $config->key }}" id="{{ $config->key }}" value="{{ $config->value }}"
                                                class="h-10 w-20 rounded border-gray-300">
                                            <span class="text-sm text-gray-500">{{ $config->value }}</span>
                                        </div>
                                    @elseif ($config->type === 'image')
                                        <div class="mt-1 flex items-center">
                                            @if ($config->value)
                                                <div class="mb-3">
                                                    <img src="{{ $config->value }}" alt="{{ $config->label }}" class="h-32 w-auto object-cover rounded-md">
                                                </div>
                                            @endif
                                            <input type="file" name="{{ $config->key }}" id="{{ $config->key }}" 
                                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                            <input type="hidden" name="{{ $config->key }}_current" value="{{ $config->value }}">
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">Deixe em branco para manter a imagem atual.</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 flex justify-end">                            <button type="submit" class="admin-button">
                                <i class="fas fa-save mr-2"></i> Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
