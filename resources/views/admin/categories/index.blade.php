<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
        </h2>
        <a href="{{ route('admin.categories.create') }}" class="ml-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nova Categoria</a>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 text-green-700 bg-green-100 border border-green-400 rounded p-2">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Ícone</th>
                            <th class="px-4 py-2">Título</th>
                            <th class="px-4 py-2">Ordem</th>
                            <th class="px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="px-4 py-2">{{ $category->id }}</td>
                                <td class="px-4 py-2">
                                    <div class="rounded-full flex items-center justify-center"
                                         style="width: 40px; height: 40px; border: 2px solid {{ $category->stroke_color }};">
                                        @if($category->icon_type === 'svg')
                                            <span style="color: {{ $category->icon_color }}; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                                                {!! str_replace('<svg ', '<svg style=\'width:24px;height:24px;\'', $category->icon_content) !!}
                                            </span>
                                        @elseif($category->icon_type === 'png')
                                            <img src="{{ asset('storage/' . $category->icon_content) }}" alt="{{ $category->title }}" style="width:24px; height:24px;">
                                        @else
                                            {!! $category->icon_content !!}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-2">{{ $category->title }}</td>
                                <td class="px-4 py-2">{{ $category->order }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 