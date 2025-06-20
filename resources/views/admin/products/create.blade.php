@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Adicionar Produto</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Nome</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium">Descrição</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" required></textarea>
        </div>
        <div>
            <label class="block font-medium">Preço</label>
            <input type="number" name="price" step="0.01" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium">Categoria</label>
            <div class="flex items-center gap-2">
                <select name="category_id" class="w-full border rounded px-3 py-2" required @if($categories->isEmpty()) disabled @endif>
                    <option value="">Selecione</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <a href="{{ route('admin.product-categories.create') }}" target="_blank" class="text-blue-600 underline text-sm whitespace-nowrap">+ Nova Categoria</a>
            </div>
            @if($categories->isEmpty())
                <p class="text-red-600 text-sm mt-1">Cadastre uma categoria de produto antes de criar produtos.</p>
            @endif
        </div>
        <div>
            <label class="block font-medium">Imagem</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
    </form>
</div>
@endsection 