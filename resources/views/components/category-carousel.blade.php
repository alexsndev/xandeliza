<div class="w-full py-8 bg-white">
    <div class="container mx-auto">
        <div x-data="{
                scrollEl: null,
                scrollInterval: null,
                scrollLeft() { this.scrollEl.scrollBy({ left: -10, behavior: 'smooth' }); },
                scrollRight() { this.scrollEl.scrollBy({ left: 10, behavior: 'smooth' }); },
                startScrollLeft() { this.stopScroll(); this.scrollInterval = setInterval(() => this.scrollLeft(), 16); },
                startScrollRight() { this.stopScroll(); this.scrollInterval = setInterval(() => this.scrollRight(), 16); },
                stopScroll() { if (this.scrollInterval) { clearInterval(this.scrollInterval); this.scrollInterval = null; } },
                blockScroll(e) {
                    // Só bloqueia se o usuário tentar rolar horizontalmente
                    if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) {
                        e.preventDefault();
                    }
                },
                init() { this.scrollEl = this.$refs.carousel; this.scrollEl.addEventListener('wheel', this.blockScroll, { passive: false }); }
            }" x-init="init" class="relative">
            <button @mousedown="startScrollLeft" @mouseup="stopScroll" @mouseleave="stopScroll" @touchstart.prevent="startScrollLeft" @touchend="stopScroll" @click="scrollLeft" class="hidden md:flex items-center justify-center absolute -left-16 top-1/2 -translate-y-1/2 z-20 bg-red-600 shadow-lg p-1.5 rounded-full hover:bg-red-700 hover:text-white transition-all duration-200 focus:outline-none text-white" style="box-shadow: 0 2px 8px rgba(0,0,0,0.10); width: 40px; height: 40px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </button>
            <div x-ref="carousel" class="flex gap-6 overflow-x-auto pb-2 category-carousel-hide-scroll select-none" style="scroll-snap-type: x mandatory; scrollbar-width: none; -ms-overflow-style: none;" tabindex="-1">
                @foreach($categories as $category)
                    <div class="flex flex-col items-center min-w-[120px] max-w-[160px] flex-shrink-0" style="scroll-snap-align: start;">
                        <div class="rounded-full flex items-center justify-center mb-2"
                             style="width: 80px; height: 80px; border: 3px solid {{ $category->stroke_color }};">
                            @if($category->icon_type === 'svg')
                                <span style="color: {{ $category->icon_color }}; width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                                    {!! str_replace('<svg ', '<svg style=\'width:48px;height:48px;\'', $category->icon_content) !!}
                                </span>
                            @elseif($category->icon_type === 'png')
                                <img src="{{ asset('storage/' . $category->icon_content) }}" alt="{{ $category->title }}" style="width:48px; height:48px;">
                            @else
                                {!! $category->icon_content !!}
                            @endif
                        </div>
                        <div class="text-sm font-semibold text-gray-800 text-center">{{ $category->title }}</div>
                    </div>
                @endforeach
            </div>
            <button @mousedown="startScrollRight" @mouseup="stopScroll" @mouseleave="stopScroll" @touchstart.prevent="startScrollRight" @touchend="stopScroll" @click="scrollRight" class="hidden md:flex items-center justify-center absolute -right-16 top-1/2 -translate-y-1/2 z-20 bg-red-600 shadow-lg p-1.5 rounded-full hover:bg-red-700 hover:text-white transition-all duration-200 focus:outline-none text-white" style="box-shadow: 0 2px 8px rgba(0,0,0,0.10); width: 40px; height: 40px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
        </div>
    </div>
</div> 