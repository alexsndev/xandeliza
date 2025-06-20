@props(['experiences'])

<style>
.carousel-experience-container {
    position: relative;
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
    height: 340px;
    overflow: hidden;
}
.carousel-experience-slide {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    opacity: 0;
    transition: opacity 0.5s;
    width: 100%;
    height: 100%;
    z-index: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.carousel-experience-slide.active {
    opacity: 1;
    z-index: 1;
}
.carousel-experience-controls {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}
.carousel-experience-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #111827;
    opacity: 0.4;
    border: 2px solid #fbbf24;
    cursor: pointer;
    transition: opacity 0.2s, background 0.2s;
}
.carousel-experience-dot.active {
    opacity: 1;
    background: #fbbf24;
}
</style>

<section class="experiences-section bg-gray-50 py-16 text-center" id="experiences">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-6">Experiências</h2>
        @if(isset($experiences) && count($experiences))
            <div class="carousel-experience-container">
                @foreach($experiences as $i => $experience)
                    <div class="carousel-experience-slide{{ $i === 0 ? ' active' : '' }}">
                        <div class="bg-white rounded shadow p-8 flex flex-col items-center w-full max-w-xl mx-auto">
                            @if(!empty($experience->image))
                                <img src="{{ Storage::url($experience->image) }}" alt="{{ $experience->title }}" class="w-full h-48 object-cover rounded mb-4">
                            @endif
                            <h3 class="font-semibold text-2xl mb-2">{{ $experience->title }}</h3>
                            <p class="text-gray-700">{{ $experience->description }}</p>
                        </div>
                    </div>
                @endforeach
                <div class="carousel-experience-controls">
                    @foreach($experiences as $i => $experience)
                        <div class="carousel-experience-dot{{ $i === 0 ? ' active' : '' }}" data-index="{{ $i }}"></div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-gray-500">Nenhuma experiência cadastrada ainda.</p>
        @endif
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carousel-experience-slide');
    const dots = document.querySelectorAll('.carousel-experience-dot');
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
        interval = setInterval(nextSlide, 3500);
    }

    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            showSlide(Number(this.dataset.index));
            startAutoplay();
        });
    });

    if(slides.length > 1) startAutoplay();
});
</script> 