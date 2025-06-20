<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Galeria') }}
            </h2>
            <a href="{{ route('admin.galleries.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Nova Imagem
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="mb-4 text-green-700 bg-green-100 border border-green-400 rounded p-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($galleries as $gallery)
                            <div class="relative bg-white rounded-lg shadow p-4 flex flex-col justify-between h-full">
                                <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-48 object-cover rounded mb-4">
                                <div class="absolute top-2 right-2 flex gap-2">
                                    <form action="{{ route('admin.galleries.toggle', $gallery) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 rounded-full text-sm {{ $gallery->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                            {{ $gallery->is_active ? 'Ativo' : 'Inativo' }}
                                        </button>
                                    </form>
                                </div>
                                <h3 class="text-lg font-semibold mb-2">{{ $gallery->title }}</h3>
                                <p class="text-sm text-gray-600 mb-2">Ordem: {{ $gallery->order }}</p>
                                <p class="text-xs text-gray-500 mb-4">{{ $gallery->description }}</p>
                                <div class="flex justify-between items-center mt-auto">
                                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Tem certeza que deseja excluir esta imagem?')">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 