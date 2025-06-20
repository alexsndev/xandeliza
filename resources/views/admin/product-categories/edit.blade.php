@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Categoria de Produto</h1>
    <form action="{{ route('admin.product-categories.update', $productCategory) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium">Nome</label>
            <input type="text" name="name" value="{{ old('name', $productCategory->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
    </form>
</div>
@endsection 