@props(['section', 'configKey'])

@php
    $currentValue = \App\Models\SiteConfig::where('key', $configKey)->value('value') ?? '#111827';
@endphp

@auth
    @if(auth()->check() && auth()->user()->role === 'admin')
        <div {{ $attributes->merge(['class' => 'group relative']) }}>
            {{ $slot }}
            @if($configKey === 'public_header_color')
                <input type="color" 
                       class="absolute opacity-0 w-0 h-0 cursor-pointer" 
                       value="{{ $currentValue }}"
                       onchange="updateHeaderColor(this.value, '{{ $section }}', '{{ $configKey }}')"
                       title="Escolher cor do header">
                <div class="absolute hidden group-hover:flex items-center justify-center top-2 right-2 w-8 h-8 bg-blue-600 bg-opacity-90 rounded-full shadow-lg transition-all duration-200 hover:bg-blue-700 cursor-pointer color-picker-trigger">
                    <i class="fas fa-paint-brush text-white text-sm"></i>
                </div>
            @else
            <div class="absolute hidden group-hover:flex items-center justify-center top-2 right-2 w-8 h-8 bg-blue-600 bg-opacity-90 rounded-full shadow-lg transition-all duration-200 hover:bg-blue-700 cursor-pointer edit-button" 
                 data-section="{{ $section }}"
                 data-key="{{ $configKey }}"
                 title="Clique para editar">
                <i class="fas fa-pencil-alt text-white text-sm"></i>
            </div>
            @endif
        </div>
    @else
        {{ $slot }}
    @endif
@else
    {{ $slot }}
@endauth

@push('scripts')
<script>
// Função para atualizar a cor do header
async function updateHeaderColor(color, section, key) {
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append(key, color);
    
    try {
        const response = await fetch(`/admin/site-config/${section}`, {
            method: 'POST',
            body: formData
        });
        
        if (response.ok) {
            window.location.reload();
        } else {
            alert('Erro ao salvar alterações');
        }
    } catch (error) {
        console.error('Erro:', error);
        alert('Erro ao salvar alterações');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Configurar o trigger do seletor de cores
    const colorPickerTriggers = document.querySelectorAll('.color-picker-trigger');
    colorPickerTriggers.forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            const colorInput = this.parentElement.querySelector('input[type="color"]');
            colorInput.click();
        });
    });

    // Configurar os botões de edição normais
    const editButtons = document.querySelectorAll('.edit-button');
    editButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const section = this.dataset.section;
            const key = this.dataset.key;
            const element = this.closest('.group');
            const isLogo = key === 'site_logo';
            const currentImg = element.querySelector('img')?.src;
            const currentValue = currentImg || element.textContent.trim();
            
            // Título amigável
            let friendlyTitle = key;
            if (key === 'site_logo') friendlyTitle = 'Logo do Site';
            else if (key === 'site_title') friendlyTitle = 'Título do Site';
            else if (key === 'site_description') friendlyTitle = 'Descrição do Site';
            else if (key === 'public_header_color') friendlyTitle = 'Cor do Header';

            // Modal base
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            modal.innerHTML = `
                <div class="bg-white rounded-lg p-6 w-96 relative" id="modalContent">
                    <h3 class="text-lg font-semibold mb-4">Editar ${friendlyTitle}</h3>
                    <div id="modalField"></div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 cancel-edit">Cancelar</button>
                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 save-edit">Salvar</button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            
            // Fechar modal ao clicar fora do conteúdo
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });

            // Função para fechar modal
            function closeModal() {
                if (modal && modal.parentNode) {
                    modal.parentNode.removeChild(modal);
                }
            }
            modal.querySelector('.cancel-edit').addEventListener('click', closeModal);

            // Campo do modal
            const modalField = modal.querySelector('#modalField');
            if (isLogo) {
                // Upload de imagem com preview
                let previewHTML = '';
                if (currentImg) {
                    previewHTML = `<img src="${currentImg}" class="w-32 h-32 object-contain mb-2 border rounded mx-auto" id="logoPreview">`;
                } else {
                    previewHTML = `<div class="w-32 h-32 flex items-center justify-center border rounded mb-2 bg-gray-50 text-gray-500 mx-auto" id="logoPreview">${element.textContent.trim()}</div>`;
                }
                modalField.innerHTML = `
                    <div class="flex flex-col items-center mb-2">
                        ${previewHTML}
                        <input type="file" class="w-full mb-2" accept="image/*" id="logoInput">
                        ${currentImg ? '<button type="button" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 mb-2 remove-logo">Usar texto como logo</button>' : ''}
                    </div>
                `;
                // Preview ao selecionar arquivo
                const fileInput = modal.querySelector('#logoInput');
                fileInput.addEventListener('change', function() {
                    const file = this.files[0];
                    const preview = modal.querySelector('#logoPreview');
                    if (file && preview) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            if (preview.tagName === 'IMG') preview.src = e.target.result;
                            else preview.innerHTML = `<img src='${e.target.result}' class='w-32 h-32 object-contain rounded'>`;
                        };
                        reader.readAsDataURL(file);
                    }
                });
                // Remover logo
                if (currentImg) {
                    modal.querySelector('.remove-logo').addEventListener('click', async function() {
                        const formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append(key, '');
                        try {
                            const response = await fetch(`/admin/site-config/${section}`, {
                                method: 'POST',
                                body: formData
                            });
                            if (response.ok) window.location.reload();
                            else alert('Erro ao remover logo');
                        } catch (error) {
                            alert('Erro ao remover logo');
                        }
                        closeModal();
                    });
                }
            } else {
                // Campo texto padrão
                modalField.innerHTML = `<textarea class="w-full h-32 p-2 border rounded" id="textEdit">${currentValue}</textarea>`;
            }
            
            // Salvar alterações
            modal.querySelector('.save-edit').addEventListener('click', async function() {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                if (isLogo) {
                    const fileInput = modal.querySelector('#logoInput');
                    if (fileInput && fileInput.files.length > 0) {
                        formData.append(key, fileInput.files[0]);
                    }
                } else {
                    const textarea = modal.querySelector('#textEdit');
                    formData.append(key, textarea.value);
                }
                try {
                    const response = await fetch(`/admin/site-config/${section}`, {
                        method: 'POST',
                        body: formData
                    });
                    if (response.ok) window.location.reload();
                    else alert('Erro ao salvar alterações');
                } catch (error) {
                    alert('Erro ao salvar alterações');
                }
                closeModal();
            });
        });
    });
});
</script>
@endpush
