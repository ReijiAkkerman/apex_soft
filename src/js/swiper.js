let aboutSwiper = new Swiper(".hero__swiper", {
    observer: true,
    observeParents: true,
    slidesPerView: 1,
    simulateTouch: true,
    grabCursor: true,
    slidesPerGroup: 1,
    spaceBetween: 30,
    speed: 800,
    direction: 'horizontal',
    loop: false,
    navigation: {
        nextEl: '.hero__swiper-next',
        prevEl: '.hero__swiper-prev',
    },
    on: {
        init: function () {
            this.slides.forEach(function (slide, index) {
                slide.setAttribute('data-slide', index + 1);
            });
        }
    }
});
