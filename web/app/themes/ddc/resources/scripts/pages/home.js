// récupère questions

import Swiper from "swiper";
import {Navigation, Pagination} from "swiper/modules";
import 'swiper/css/bundle';
import 'swiper/css/navigation';

import '../sections/faq';

// Collect the titles of the gîtes
let giteTitles = [];
document.querySelectorAll('.gite-card .h1').forEach((element) => {
    giteTitles.push(element.textContent);
});

let swiperGite = new Swiper('.swiper-gite', {
    modules: [Navigation, Pagination],
    loop: true,
    autoHeight: true, //enable auto height
    navigation: {
        nextEl: '.next-gite',
        prevEl: '.prev-gite',
    },
    pagination: {
        el: '.pagination-gite',
        clickable: true,

        renderBullet: function (index, className) {
            return '<span class="' + className + ' btn">' + giteTitles[index] + '</span>';
        },
    },

});

let swiperActivity = new Swiper('.swiper-activity', {
    modules: [Navigation, Pagination],
    autoHeight: true, //enable auto height
    loop: true,
    navigation: {
        nextEl: '.next-activity',
        prevEl: '.prev-activity',
    },
    pagination: {
        el: '.pagination-activity',
        clickable: true,
        dynamicBullets: true,
        dynamicMainBullets: 3
    },
  // media queries
    breakpoints: {
        768: {
            slidesPerView: 3,
        }
    }

});



