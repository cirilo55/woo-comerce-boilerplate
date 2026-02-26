document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.querySelector('.carousel-wrapper');
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    let currentSlide = 0;
    let autoSlideTimer;
    let isTransitioning = false;

    function showSlide(index) {
        if (isTransitioning) return;
        
        isTransitioning = true;
        currentSlide = (index + slides.length) % slides.length;

        slides.forEach((slide, i) => {
            slide.classList.remove('carousel-slide-active');
            if (i === currentSlide) {
                slide.classList.add('carousel-slide-active');
            }
        });

        dots.forEach((dot, i) => {
            dot.classList.remove('active');
            if (i === currentSlide) {
                dot.classList.add('active');
            }
        });

        wrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Reset transition lock after animation completes (1s from CSS)
        setTimeout(() => {
            isTransitioning = false;
        }, 1000);
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function autoSlide() {
        nextSlide();
        resetAutoSlideTimer();
    }

    function resetAutoSlideTimer() {
        clearInterval(autoSlideTimer);
        autoSlideTimer = setInterval(autoSlide, 5000);
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            resetAutoSlideTimer();
        });
    });

    autoSlideTimer = setInterval(autoSlide, 5000);
});

// Carousel de Produtos
document.addEventListener('DOMContentLoaded', function() {
    const productsCarousel = document.querySelector('.products-carousel');
    const prevBtn = document.querySelector('.carousel-arrow.prev');
    const nextBtn = document.querySelector('.carousel-arrow.next');

    if (!productsCarousel) return;

    const scrollAmount = 280; // Width of one product card + gap

    function scrollCarousel(direction) {
        const scrollLeft = productsCarousel.scrollLeft;
        const targetScroll = direction === 'next' 
            ? scrollLeft + scrollAmount 
            : scrollLeft - scrollAmount;
        
        productsCarousel.scrollTo({
            left: targetScroll,
            behavior: 'smooth'
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => scrollCarousel('prev'));
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => scrollCarousel('next'));
    }
});
