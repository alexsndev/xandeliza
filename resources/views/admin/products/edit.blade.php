@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Produto</h1>
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium">Nome</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium">Descrição</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" required>{{ old('description', $product->description) }}</textarea>
        </div>
        <div>
            <label class="block font-medium">Preço</label>
            <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium">Categoria</label>
            <div class="flex items-center gap-2">
                <select name="category_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Selecione</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(old('category_id', $product->product_category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                <a href="{{ route('admin.product-categories.create') }}" target="_blank" class="text-blue-600 underline text-sm whitespace-nowrap">+ Nova Categoria</a>
            </div>
        </div>
        <div>
            <label class="block font-medium">Imagem</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
            @if($product->image)
                <div class="mt-2">
                    <span class="text-xs text-gray-500">Imagem atual:</span><br>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded">
                </div>
            @endif
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
    </form>
</div>
@endsection 