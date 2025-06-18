<button type="{{ $type }}"
        class="{{ $class }} px-6 py-2 rounded font-semibold transition"
        style="background: {{ $color }}; color: #fff; position: relative;">
    {{ $slot }}
    @auth
        @if(auth()->user()->role === 'admin')
            <span style="position: absolute; right: 8px; top: 8px; z-index: 2; pointer-events: none;">
                <i class="fas fa-paint-brush" style="color: #fff; opacity: 0.8;"></i>
            </span>
            <input type="color"
                   value="{{ $color }}"
                   onchange="updateButtonColor(this.value, '{{ $section }}', '{{ $configKey }}')"
                   style="position: absolute; right: 8px; top: 8px; width: 28px; height: 28px; opacity: 0; cursor: pointer; border: none; background: transparent; z-index: 3;">
        @endif
    @endauth
</button> 