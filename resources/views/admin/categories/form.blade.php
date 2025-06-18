@php use Illuminate\Support\Str; @endphp
<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
        <input type="text" name="title" id="title" value="{{ old('title', $category->title ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
    </div>

    <div>
        <label for="icon_type" class="block text-sm font-medium text-gray-700">Tipo de Ícone</label>
        <select name="icon_type" id="icon_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required onchange="toggleIconInput()">
            <option value="svg" {{ old('icon_type', $category->icon_type ?? '') == 'svg' ? 'selected' : '' }}>SVG</option>
            <option value="png" {{ old('icon_type', $category->icon_type ?? '') == 'png' ? 'selected' : '' }}>PNG</option>
            <option value="code" {{ old('icon_type', $category->icon_type ?? '') == 'code' ? 'selected' : '' }}>Código</option>
        </select>
    </div>

    <div id="icon-content-textarea" style="display: none;">
        <label for="icon_content" class="block text-sm font-medium text-gray-700">Conteúdo do Ícone<br><span class="text-xs text-gray-500">Cole o SVG, código ou envie o caminho do PNG (ex: icons/minha.png)</span></label>
        <textarea name="icon_content" id="icon_content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('icon_content', $category->icon_content ?? '') }}</textarea>
    </div>

    <div id="icon-content-file" style="display: none;">
        <label for="icon_file" class="block text-sm font-medium text-gray-700">Upload do Ícone (SVG ou PNG)</label>
        <input type="file" name="icon_file" id="icon_file" accept=".svg,.png,image/svg+xml,image/png" class="mt-1 block w-full text-sm text-gray-700">
        @if(!empty($category->icon_content) && ($category->icon_type === 'svg' || $category->icon_type === 'png'))
            <div class="mt-2">
                <span class="text-xs text-gray-500">Ícone atual:</span><br>
                @if($category->icon_type === 'svg')
                    @if(Str::startsWith($category->icon_content, '<svg'))
                        {!! $category->icon_content !!}
                    @else
                        <object data="{{ asset('storage/' . $category->icon_content) }}" type="image/svg+xml" width="40" height="40"></object>
                    @endif
                @elseif($category->icon_type === 'png')
                    <img src="{{ asset('storage/' . $category->icon_content) }}" alt="Ícone atual" width="40" height="40">
                @endif
            </div>
        @endif
    </div>

    <div>
        <label for="stroke_color" class="block text-sm font-medium text-gray-700">Cor do Traçado (hex)</label>
        <input type="color" name="stroke_color" id="stroke_color" value="{{ old('stroke_color', $category->stroke_color ?? '#111827') }}" class="mt-1 block w-16 h-8 p-0 border-0">
    </div>

    <div>
        <label for="icon_color" class="block text-sm font-medium text-gray-700">Cor do Ícone (hex, só SVG)</label>
        <input type="color" name="icon_color" id="icon_color" value="{{ old('icon_color', $category->icon_color ?? '#2563eb') }}" class="mt-1 block w-16 h-8 p-0 border-0">
    </div>

    <div>
        <label for="order" class="block text-sm font-medium text-gray-700">Ordem</label>
        <input type="number" name="order" id="order" value="{{ old('order', $category->order ?? 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>
</div>
<script>
function toggleIconInput() {
    var type = document.getElementById('icon_type').value;
    document.getElementById('icon-content-textarea').style.display = (type === 'code') ? '' : 'none';
    document.getElementById('icon-content-file').style.display = (type === 'svg' || type === 'png') ? '' : 'none';
}
document.addEventListener('DOMContentLoaded', toggleIconInput);
</script> 