@props(['banners'])

<style>
.carousel-banner-container {
    position: relative;
    width: 100%;
    height: 600px;
    overflow: hidden;
}
.carousel-banner-slide {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    opacity: 0;
    transition: opacity 0.5s;
    width: 100%;
    height: 100%;
    z-index: 0;
}
.carousel-banner-slide.active {
    opacity: 1;
    z-index: 1;
}
.carousel-banner-controls {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}
.carousel-banner-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #fff;
    opacity: 0.5;
    border: 2px solid #f87171;
    cursor: pointer;
    transition: opacity 0.2s, background 0.2s;
}
.carousel-banner-dot.active {
    opacity: 1;
    background: #f87171;
}
</style>

<div class="carousel-banner-container">
    @foreach($banners as $i => $banner)
        <div class="carousel-banner-slide{{ $i === 0 ? ' active' : '' }}">
            <picture>
                <source media="(min-width: 768px)" srcset="{{ asset('storage/' . $banner->desktop_image) }}">
                <img src="{{ asset('storage/' . $banner->mobile_image) }}" alt="{{ $banner->title }}" class="w-full h-[600px] object-cover">
            </picture>
            <div class="absolute inset-0 flex items-center {{ $banner->text_position === 'left' ? 'justify-start' : ($banner->text_position === 'right' ? 'justify-end' : 'justify-center') }}">
                <div class="container mx-auto">
                    <div class="max-w-2xl
                        @if($banner->text_position === 'center') mx-auto text-center
                        @elseif($banner->text_position === 'right') ml-auto text-right
                        @else text-left @endif">
                        <h2 class="text-4xl font-bold mb-4 text-white drop-shadow-lg">{{ $banner->title }}</h2>
                        <p class="text-xl mb-6 text-white drop-shadow-lg">{{ $banner->subtitle }}</p>
                        @if(!empty($banner->button_text))
                        <a href="{{ $banner->button_link }}" class="inline-block bg-white text-gray-900 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition-colors min-w-[200px] text-center">
                            <span class="text-gray-900 font-bold text-lg">{{ $banner->button_text }}</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="carousel-banner-controls">
        @foreach($banners as $i => $banner)
            <div class="carousel-banner-dot{{ $i === 0 ? ' active' : '' }}" data-index="{{ $i }}"></div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carousel-banner-slide');
    const dots = document.querySelectorAll('.carousel-banner-dot');
    let current = 0;
    let interval = null;

    function showSlide(idx) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === idx);
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === idx);
        });
        current = idx;
    }

    function nextSlide() {
        let next = (current + 1) % slides.length;
        showSlide(next);
    }

    function startAutoplay() {
        if (interval) clearInterval(interval);
        interval = setInterval(nextSlide, 3000);
    }

    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            showSlide(Number(this.dataset.index));
            startAutoplay();
        });
    });

    startAutoplay();
});
</script> 