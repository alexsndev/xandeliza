<section class="products-section bg-white py-16 text-center">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-6">Produtos</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @if(isset($products) && count($products))
                @foreach($products as $product)
                    <div class="bg-gray-50 rounded-lg shadow p-6 flex flex-col items-center">
                        @if(!empty($product->image))
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded mb-4">
                        @endif
                        <h3 class="font-semibold text-xl mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-2">{{ $product->description }}</p>
                        <p class="text-lg font-bold text-indigo-700 mb-2">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                        @if(isset($product->category) && !empty($product->category->name))
                            <span class="text-sm text-gray-500 mb-2">Categoria: {{ $product->category->name }}</span>
                        @endif
                        <span class="text-xs text-gray-400">Estoque: {{ $product->stock }}</span>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500 col-span-3">Nenhum produto cadastrado.</p>
            @endif
        </div>
    </div>
</section> 