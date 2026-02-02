let currentIndex = 0;
const totalSlides = 3;

const carouselTrack = document.getElementById('carouselTrack');
const indicators = document.querySelectorAll('.indicator');
const prevBtn = document.querySelector('.carousel-btn-prev');
const nextBtn = document.querySelector('.carousel-btn-next');


function updateCarousel() {
    const offset = -currentIndex * 100;
    carouselTrack.style.transform = `translateX(${offset}%)`;
    

    indicators.forEach((indicator, index) => {
        if (index === currentIndex) {
            indicator.classList.add('active');
        } else {
            indicator.classList.remove('active');
        }
    });
}

// BACK
prevBtn.addEventListener('click', () => {
    currentIndex = currentIndex === 0 ? totalSlides - 1 : currentIndex - 1;
    updateCarousel();
});

// NEXT
nextBtn.addEventListener('click', () => {
    currentIndex = currentIndex === totalSlides - 1 ? 0 : currentIndex + 1;
    updateCarousel();
});


indicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
        currentIndex = index;
        updateCarousel();
    });
});

// MOBILE SUPPORT
let touchStartX = 0;
let touchEndX = 0;

carouselTrack.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
});

carouselTrack.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    if (touchEndX < touchStartX - 50) {
        // LEFT SWIPE
        currentIndex = currentIndex === totalSlides - 1 ? 0 : currentIndex + 1;
        updateCarousel();
    }
    if (touchEndX > touchStartX + 50) {
        // RIGHT SWIPE
        currentIndex = currentIndex === 0 ? totalSlides - 1 : currentIndex - 1;
        updateCarousel();
    }
}


document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
        currentIndex = currentIndex === 0 ? totalSlides - 1 : currentIndex - 1;
        updateCarousel();
    } else if (e.key === 'ArrowRight') {
        currentIndex = currentIndex === totalSlides - 1 ? 0 : currentIndex + 1;
        updateCarousel();
    }
});
