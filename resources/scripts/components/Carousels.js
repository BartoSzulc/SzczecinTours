import Component from "./Component";
import Swiper from "swiper";
import { Autoplay, EffectFade, Pagination, Navigation, } from 'swiper/modules';

Swiper.use([Pagination, Autoplay, EffectFade, Navigation]);

export default class Carousels extends Component {

    constructor() {
        super();
        this.heroSlider = document.querySelector('.home__hero') !== null;
        this.productSlider = document.querySelector('.single__content') !== null;
      
    }

    init() {
        if (this.heroSlider) {
            document.querySelectorAll('.heroSwiper').forEach(el => {
                new Swiper(el, {
                    simulateTouch: false,
                    slidesPerView: 1,
                    effect: "fade",
                    speed: 3000,
                    loop: true,
                    fadeEffect: {
                        crossFade: true
                    },
                    autoplay: {
                        delay: 4000,
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
            document.querySelectorAll('.singleSwiper').forEach(el => {
                let productSwiper = new Swiper(el, {
                    effect: "fade",
                    fadeEffect: {
                        crossFade: true
                    },
                    simulateTouch: false,
                    slidesPerView: 1,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                });
                
            });
        }
        
    }

}