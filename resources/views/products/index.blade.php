@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Produtos</h1>
    <div class="mb-6 flex flex-wrap gap-4 items-center">
        <form method="GET" action="{{ route('produtos.index') }}" class="flex gap-2 items-center">
            <label for="categoria" class="font-semibold">Filtrar por categoria:</label>
            <select name="categoria" id="categoria" class="border rounded px-2 py-1" onchange="this.form.submit()">
                <option value="">Todas</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" @if($categorySlug == $cat->slug) selected @endif>{{ $cat->name }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow p-6 flex flex-col">
                <div class="mb-4">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded">
                    @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center rounded text-gray-400">Sem imagem</div>
                    @endif
                </div>
                <h2 class="text-xl font-semibold mb-2">
                    <x-edit-overlay section="product" configKey="name_{{ $product->id }}">
                        {{ $product->name }}
                    </x-edit-overlay>
                </h2>
                <div class="text-sm text-gray-500 mb-2">
                    Categoria: {{ $product->category->name ?? '-' }}
                </div>
                <div class="mb-2">
                    <x-edit-overlay section="product" configKey="description_{{ $product->id }}">
                        {{ $product->description }}
                    </x-edit-overlay>
                </div>
                <div class="font-bold text-lg mb-4">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
                <div class="mb-2 text-sm text-gray-600">Estoque: {{ $product->stock }}</div>
                <button class="btn-primary mt-auto" disabled>Comprar (Mercado Pago em breve)</button>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500">Nenhum produto encontrado.</div>
        @endforelse
    </div>
</div>
@endsection 