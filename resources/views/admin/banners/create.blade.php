<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Banner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="space-y-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="subtitle" class="block text-sm font-medium text-gray-700">Subtítulo</label>
                                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="button_text" class="block text-sm font-medium text-gray-700">Texto do Botão</label>
                                <input type="text" name="button_text" id="button_text" value="{{ old('button_text') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="button_link" class="block text-sm font-medium text-gray-700">Link do Botão</label>
                                <input type="text" name="button_link" id="button_link" value="{{ old('button_link') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="text_position" class="block text-sm font-medium text-gray-700">Posição do Texto</label>
                                <select name="text_position" id="text_position" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="left" {{ old('text_position') == 'left' ? 'selected' : '' }}>Esquerda</option>
                                    <option value="center" {{ old('text_position') == 'center' ? 'selected' : '' }}>Centro</option>
                                    <option value="right" {{ old('text_position') == 'right' ? 'selected' : '' }}>Direita</option>
                                </select>
                            </div>

                            <div>
                                <label for="desktop_image" class="block text-sm font-medium text-gray-700">Imagem Desktop (1920x600px)</label>
                                <input type="file" name="desktop_image" id="desktop_image" class="mt-1 block w-full" required>
                            </div>

                            <div>
                                <label for="mobile_image" class="block text-sm font-medium text-gray-700">Imagem Mobile (768x600px)</label>
                                <input type="file" name="mobile_image" id="mobile_image" class="mt-1 block w-full" required>
                            </div>

                            <div>
                                <label for="order" class="block text-sm font-medium text-gray-700">Ordem</label>
                                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">Ativo</label>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Criar Banner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 