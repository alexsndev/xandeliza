<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Experiências Profissionais') }}
            </h2>
            <a href="{{ route('admin.experiences.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Nova Experiência
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
                        @foreach($experiences as $experience)
                            <div class="relative bg-white rounded-lg shadow p-4 flex flex-col justify-between h-full">
                                @if($experience->image)
                                    <img src="{{ Storage::url($experience->image) }}" alt="{{ $experience->name }}" class="w-full h-32 object-contain rounded mb-4 bg-gray-50">
                                @endif
                                <div class="absolute top-2 right-2 flex gap-2">
                                    <form action="{{ route('admin.experiences.toggle', $experience) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 rounded-full text-sm {{ $experience->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                            {{ $experience->is_active ? 'Ativo' : 'Inativo' }}
                                        </button>
                                    </form>
                                </div>
                                <h3 class="text-lg font-semibold mb-2 text-center">{{ $experience->name }}</h3>
                                <p class="text-sm text-gray-600 mb-2 text-center">Ordem: {{ $experience->order }}</p>
                                <div class="flex justify-between items-center mt-auto">
                                    <a href="{{ route('admin.experiences.edit', $experience) }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                                    <form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Tem certeza que deseja excluir esta experiência?')">Excluir</button>
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