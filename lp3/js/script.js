new Swiper('.card-wrapper', {
    loop: true,
    speed: 700,
    spaceBetween: 0,
    slidesPerView: 'auto',
    centeredSlides: true,

    // If we need pagination  
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: true,
    },

    // Navigation arrows  
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    }
});
