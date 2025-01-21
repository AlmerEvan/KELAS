let currentIndex = 0;

function nextSlide() {
    const slider = document.querySelector('.kategori-slider');
    const totalItems = document.querySelectorAll('.kategori-item').length;
    currentIndex = (currentIndex + 1) % totalItems;
    slider.style.transform = `translateX(-${currentIndex * 150}px)`;
}

function prevSlide() {
    const slider = document.querySelector('.kategori-slider');
    const totalItems = document.querySelectorAll('.kategori-item').length;
    currentIndex = (currentIndex - 1 + totalItems) % totalItems;
    slider.style.transform = `translateX(-${currentIndex * 150}px)`;
}

