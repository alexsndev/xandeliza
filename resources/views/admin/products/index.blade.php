@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Painel de Produtos</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Adicionar Produto</a>
    </div>
    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 border border-green-400 rounded p-2">
            {{ session('success') }}
        </div>
    @endif
    <table class="min-w-full divide-y divide-gray-200 mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Categoria</th>
                <th class="px-4 py-2">Preço</th>
                <th class="px-4 py-2">Imagem</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="px-4 py-2">{{ $product->id }}</td>
                    <td class="px-4 py-2">{{ $product->name }}</td>
                    <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                    <td class="px-4 py-2">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td class="px-4 py-2">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                        {{-- Botões de excluir podem ser adicionados aqui --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">Nenhum produto cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 