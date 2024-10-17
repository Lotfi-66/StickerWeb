import Swiper from "swiper";
import {Navigation, Pagination} from "swiper/modules";
import 'swiper/css/bundle';
import 'swiper/css/navigation';

import '../sections/faq';

let swiperGite = new Swiper('.gite-photos', {
    modules: [Navigation, Pagination],
    loop: true,
    navigation: {
        nextEl: '.next-gite',
        prevEl: '.prev-gite',
    },
    pagination: {
        el: '.pagination-gite',
        clickable: true,
        dynamicBullets: true,
        dynamicMainBullets: 3

    },

});

import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';

document.addEventListener('DOMContentLoaded', function () {
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        openEffect: 'fade',
        closeEffect: 'fade',
    });

    const all360Img = document.querySelectorAll('.img-360');
    all360Img.forEach((img360) => {
        lightbox.insertSlide({
            content: '<a href="' + img360.href + '" class="btn" style="text-align: center;" target="_blank">Cliquez ici pour voir en 360°</a>',
        });
    });

});
