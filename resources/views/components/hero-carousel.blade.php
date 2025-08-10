{{--
    File: resources/views/components/_hero-carousel.blade.php
    Variabel yang dibutuhkan: $slides (array of objects/arrays with 'image', 'title', 'description', 'buttons')
--}}
@if(isset($slides) && count($slides) > 0)
    <section class="relative h-[500px] overflow-hidden">
        <div id="hero-carousel" class="flex h-full transition-transform duration-700 ease-in-out" style="transform: translateX(0%);">
            @foreach($slides as $index => $slide)
                <div class="w-full flex-shrink-0 h-full relative bg-cover bg-center flex items-center justify-center text-white"
                     style="background-image: url('{{ asset($slide['image']) }}');"
                     data-carousel-item="{{ $index }}">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div class="relative z-10 text-center space-y-4 px-4">
                        <h2 class="text-3xl md:text-5xl font-bold">{{ $slide['title'] }}</h2>
                        <p class="text-lg md:text-xl">{{ $slide['description'] }}</p>
                        @if(isset($slide['buttons']) && count($slide['buttons']) > 0)
                            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
                                @foreach($slide['buttons'] as $button)
                                    <a href="{{ $button['href'] }}"
                                       class="{{ $button['class'] }} px-6 py-3 rounded-lg font-semibold transition-colors">
                                        {{ $button['text'] }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Carousel controls - Prev -->
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none opacity-50" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/60 group-hover:bg-white/80 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <!-- Carousel controls - Next -->
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none opacity-50" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/60 group-hover:bg-white/80 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>

        <!-- Carousel indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            @foreach($slides as $index => $slide)
                <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
            @endforeach
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('hero-carousel');
            if (!carousel) return;

            const items = carousel.querySelectorAll('[data-carousel-item]');
            const prevBtn = document.querySelector('[data-carousel-prev]');
            const nextBtn = document.querySelector('[data-carousel-next]');
            const indicatorsContainer = document.querySelector('#hero-carousel + .absolute.bottom-5'); // Select indicators relative to carousel
            const indicators = indicatorsContainer ? indicatorsContainer.querySelectorAll('button') : [];

            let currentIndex = 0;
            const totalItems = items.length;
            let autoSlideInterval;

            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                indicators.forEach((indicator, index) => {
                    if (index === currentIndex) {
                        indicator.classList.add('bg-white');
                        indicator.classList.remove('bg-white/50');
                        indicator.setAttribute('aria-current', 'true');
                    } else {
                        indicator.classList.remove('bg-white');
                        indicator.classList.add('bg-white/50');
                        indicator.setAttribute('aria-current', 'false');
                    }
                });
            }

            function showNext() {
                currentIndex = (currentIndex + 1) % totalItems;
                updateCarousel();
            }

            function showPrev() {
                currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                updateCarousel();
            }

            function goToSlide(index) {
                currentIndex = index;
                updateCarousel();
            }

            function startAutoSlide() {
                stopAutoSlide(); // Clear any existing interval
                autoSlideInterval = setInterval(showNext, 5000); // Change slide every 5 seconds
            }

            function stopAutoSlide() {
                if (autoSlideInterval) {
                    clearInterval(autoSlideInterval);
                }
            }

            // Event Listeners
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    showNext();
                    startAutoSlide(); // Reset timer on manual interaction
                });
            }
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    showPrev();
                    startAutoSlide(); // Reset timer on manual interaction
                });
            }

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    goToSlide(index);
                    startAutoSlide(); // Reset timer on manual interaction
                });
            });

            // Initialize carousel
            updateCarousel();
            startAutoSlide(); // Start auto-sliding on load

            // Pause auto-slide when mouse is over carousel
            carousel.closest('section').addEventListener('mouseenter', stopAutoSlide);
            carousel.closest('section').addEventListener('mouseleave', startAutoSlide);
        });
    </script>
@else
    <section class="relative h-[500px] bg-cover bg-center flex items-center justify-center text-white"
        style="background-image: url('{{ asset('images/home/unnamed.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center space-y-4 px-4">
            <h2 class="text-3xl md:text-5xl font-bold">Selamat Datang di Desa Metesih</h2>
            <p class="text-lg md:text-xl">Sumber informasi terbaru tentang pemerintahan di Desa Metesih</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
                <a href="{{ route('profil-desa') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                    Profil Desa
                </a>
                <a href="{{ route('pemerintahan-desa') }}"
                   class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                    Pemerintahan Desa
                </a>
            </div>
        </div>
    </section>
@endif
