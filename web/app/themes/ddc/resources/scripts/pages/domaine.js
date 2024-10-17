import Swiper from "swiper";
import {Navigation, Pagination} from "swiper/modules";
import 'swiper/css/bundle';
import 'swiper/css/navigation';

let swiperActivity = new Swiper('.swiper-domaine', {
    modules: [Navigation, Pagination],
    autoHeight: true, //enable auto height
    loop: true,
    navigation: {
        nextEl: '.next',
        prevEl: '.prev',
    },
    pagination: {
        el: '.pagination-activity',
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
