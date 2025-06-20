<section class="galleries-section bg-white py-16 text-center" id="galleries">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-6">Galeria</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @if(isset($galleries) && count($galleries))
                @foreach($galleries as $gallery)
                    <div class="rounded shadow p-4 bg-gray-50">
                        <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title ?? 'Imagem da Galeria' }}" class="w-full h-64 object-cover rounded mb-2">
                        @if(!empty($gallery->title))
                            <h3 class="font-semibold text-lg mb-1">{{ $gallery->title }}</h3>
                        @endif
                        @if(!empty($gallery->description))
                            <p class="text-gray-600">{{ $gallery->description }}</p>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">Nenhuma imagem na galeria ainda.</p>
            @endif
        </div>
    </div>
</section> 