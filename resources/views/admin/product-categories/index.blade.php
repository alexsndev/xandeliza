@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Categorias de Produtos</h1>
        <a href="{{ route('admin.product-categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Nova Categoria</a>
    </div>
    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 border border-green-400 rounded p-2">
            {{ session('success') }}
        </div>
    @endif
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td class="px-4 py-2">{{ $category->id }}</td>
                    <td class="px-4 py-2">{{ $category->name }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.product-categories.edit', $category) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                        <form action="{{ route('admin.product-categories.destroy', $category) }}" method="POST" class="inline">
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
@endsection 