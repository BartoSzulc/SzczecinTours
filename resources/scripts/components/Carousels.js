import Component from "./Component";
import Swiper from "swiper";
import { Autoplay, EffectFade, Pagination, Navigation, } from 'swiper/modules';

Swiper.use([Pagination, Autoplay, EffectFade, Navigation]);

export default class Carousels extends Component {

    constructor() {
        super();
        this.heroSlider = document.querySelector('.home__hero') !== null;
        this.testimonialSlider = document.querySelector('.home__testimonials') !== null;
        this.productSlider = document.querySelector('.single-produkty') !== null;
        this.productSwipers = []; // Array to store productSwiper instances
    }

    init() {
        if (this.heroSlider) {
            document.querySelectorAll('.heroSwiper').forEach(el => {
                new Swiper(el, {
                    simulateTouch: false,
                    slidesPerView: 1,
                    effect: "fade",
                    speed: 2500,
                    loop: true,
                    fadeEffect: {
                        crossFade: true
                    },
                    autoplay: {
                        delay: 2000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                      },
                });
            });
        }
        if (this.productSlider) {
            document.querySelectorAll('.productSwiper').forEach(el => {
                let productSwiper = new Swiper(el, {
                    effect: "fade",
                    fadeEffect: {
                        crossFade: true
                    },
                    simulateTouch: false,
                    allowTouchMove: false,
                    slidesPerView: 1,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                });
                this.productSwipers.push(productSwiper);
            });
        }
        if (this.testimonialSlider) {
            document.querySelectorAll('.testimonialsSwiper').forEach(el => {

                let testimonialSwiper = new Swiper(el, {
                    simulateTouch: false,
                    slidesPerView: 1,
                    spaceBetween: 20,
                    loop: true,
                    speed: 500,
                    breakpoints: {
                        
                        480: {
                          slidesPerView: 1 ,
                          spaceBetween: 20,
                          centeredSlides: true,
                        },
                        640: {
                          slidesPerView: 1,
                          spaceBetween: 20,
                          centeredSlides: true,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                            centeredSlides: true,
                            initialSlide: 1,
                        },
                        1024: {
                            slidesPerView: 2,
                            spaceBetween: 20
                        },
                        1366: {
                            slidesPerView: 2,
                            spaceBetween: 20
                        },
                        1400: {
                            slidesPerView: 3,
                            spaceBetween: 20,
                            
                        },
                    },
                    
                });
                const prevBtn = el.querySelector('.testimonialsSwiper__nav--prev'),
                nextBtn = el.querySelector('.testimonialsSwiper__nav--next');
                    
                    if (prevBtn != null) {
                        prevBtn.addEventListener('click', () => {
                            testimonialSwiper.slidePrev()
                        }, false);
                    }

                    if (nextBtn != null) {
                        nextBtn.addEventListener('click', () => {
                            testimonialSwiper.slideNext()
                        }, false);
                    }
            });
        }
    }
    getProductSwipers() {
        return this.productSwipers;
    }
}