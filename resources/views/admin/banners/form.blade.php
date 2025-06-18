@if ($errors->any())
    <div class="mb-4">
        <ul class="text-red-600 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
        <input type="text" name="title" id="title" value="{{ old('title', $banner->title ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    <div>
        <label for="subtitle" class="block text-sm font-medium text-gray-700">Subtítulo</label>
        <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $banner->subtitle ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    <div>
        <label for="button_text" class="block text-sm font-medium text-gray-700">Texto do Botão</label>
        <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $banner->button_text ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    <div>
        <label for="button_link" class="block text-sm font-medium text-gray-700">Link do Botão</label>
        <input type="text" name="button_link" id="button_link" value="{{ old('button_link', $banner->button_link ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    <div>
        <label for="text_position" class="block text-sm font-medium text-gray-700">Posição do Texto</label>
        <select name="text_position" id="text_position" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <option value="left" {{ (old('text_position', $banner->text_position ?? '') == 'left') ? 'selected' : '' }}>Esquerda</option>
            <option value="center" {{ (old('text_position', $banner->text_position ?? '') == 'center') ? 'selected' : '' }}>Centro</option>
            <option value="right" {{ (old('text_position', $banner->text_position ?? '') == 'right') ? 'selected' : '' }}>Direita</option>
        </select>
    </div>

    <div>
        <label for="desktop_image" class="block text-sm font-medium text-gray-700">Imagem Desktop (1920x600px)</label>
        <input type="file" name="desktop_image" id="desktop_image" accept="image/*" class="mt-1 block w-full">
        <img id="desktop_preview" class="mt-2 h-20 w-auto" style="display:none;">
        @if(isset($banner) && $banner->desktop_image)
            <img src="{{ asset('storage/' . $banner->desktop_image) }}" alt="Desktop Preview" class="mt-2 h-20 w-auto">
        @endif
    </div>

    <div>
        <label for="mobile_image" class="block text-sm font-medium text-gray-700">Imagem Mobile (768x600px)</label>
        <input type="file" name="mobile_image" id="mobile_image" accept="image/*" class="mt-1 block w-full">
        <img id="mobile_preview" class="mt-2 h-20 w-auto" style="display:none;">
        @if(isset($banner) && $banner->mobile_image)
            <img src="{{ asset('storage/' . $banner->mobile_image) }}" alt="Mobile Preview" class="mt-2 h-20 w-auto">
        @endif
    </div>

    <div>
        <label for="order" class="block text-sm font-medium text-gray-700">Ordem</label>
        <input type="number" name="order" id="order" value="{{ old('order', $banner->order ?? 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    <div class="flex items-center">
        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $banner->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
        <label for="is_active" class="ml-2 block text-sm text-gray-900">Ativo</label>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function convertToWebp(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const img = new Image();
            img.src = URL.createObjectURL(file);
            img.onload = function() {
                const canvas = document.createElement('canvas');
                canvas.width = img.width;
                canvas.height = img.height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);
                canvas.toBlob(function(blob) {
                    // Mostra preview
                    preview.src = URL.createObjectURL(blob);
                    preview.style.display = 'block';
                    // Cria um novo arquivo WebP para enviar
                    const webpFile = new File([blob], file.name.replace(/\.[^/.]+$/, "") + ".webp", {type: "image/webp"});
                    // Substitui o arquivo no input
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(webpFile);
                    input.files = dataTransfer.files;
                    input.setAttribute('data-converted', 'true');
                }, 'image/webp', 0.9);
            };
        });
    }
    convertToWebp('desktop_image', 'desktop_preview');
    convertToWebp('mobile_image', 'mobile_preview');

    // Intercepta o submit do formulário para garantir que a conversão terminou
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const desktopInput = document.getElementById('desktop_image');
        const mobileInput = document.getElementById('mobile_image');
        if (
            (desktopInput.files.length && desktopInput.getAttribute('data-converted') !== 'true') ||
            (mobileInput.files.length && mobileInput.getAttribute('data-converted') !== 'true')
        ) {
            e.preventDefault();
            // Aguarda a conversão terminar e submete novamente
            setTimeout(() => form.requestSubmit(), 300);
        }
    });
});
</script> 