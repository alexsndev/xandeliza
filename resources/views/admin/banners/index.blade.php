<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Banners') }}
            </h2>
            <a href="{{ route('admin.banners.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Novo Banner
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($banners as $banner)
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <div class="relative">
                                    <img src="{{ Storage::url($banner->desktop_image) }}" alt="{{ $banner->title }}" class="w-full h-48 object-cover">
                                    <div class="absolute top-2 right-2">
                                        <form action="{{ route('admin.banners.toggle', $banner) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 rounded-full text-sm {{ $banner->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                                {{ $banner->is_active ? 'Ativo' : 'Inativo' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2">{{ $banner->title }}</h3>
                                    <p class="text-sm text-gray-600 mb-4">Ordem: {{ $banner->order }}</p>
                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('admin.banners.edit', $banner) }}" class="text-blue-500 hover:text-blue-700">
                                            Editar
                                        </a>
                                        <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Tem certeza que deseja excluir este banner?')">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 