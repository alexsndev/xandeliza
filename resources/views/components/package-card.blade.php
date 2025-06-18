@props(['package', 'type', 'configs'])

@php
    $buttonColor = $configs['primary_button_color'] ?? '#111827';
@endphp

<div class="bg-gray-50 rounded-lg shadow p-8 text-center @if($type=='popular') border-2 border-neutral-900 @endif">
    @if($type=='popular')
        <div class="mb-2 text-xs uppercase tracking-widest text-neutral-900 font-bold">Mais Popular</div>
    @endif
    
    <h3 class="font-bold text-xl mb-2">{{ $package['name'] }}</h3>
    
    <div class="text-3xl font-bold mb-4">
        R$ {{ number_format($package['price'], 0, ',', '.') }}
        <span class="text-base font-normal">/mês</span>
    </div>
    
    <ul class="text-center mb-6 space-y-2">
        @foreach($package['features'] as $feature)
            <li class="flex items-center justify-center">
                <i class="fas fa-check mr-2" style="color: var(--package-{{ $type }}-color)"></i>
                    <span class="feature-text">{{ $feature }}</span>
                </li>
        @endforeach
    </ul>
    
    <a href="#contact" class="inline-block px-6 py-2 rounded font-semibold hover:opacity-90 transition" style="background-color: {{ $buttonColor }}; color: #fff;">
        Contratar Agora
    </a>
</div>
