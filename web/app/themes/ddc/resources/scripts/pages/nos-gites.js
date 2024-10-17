import Swiper from "swiper";
import { Navigation, Pagination} from "swiper/modules";
import 'swiper/css/bundle';
import 'swiper/css/navigation';

// initialisation du premier swiper

const AllGites = document.querySelectorAll('.swiper');

let countSwiper = 0;
AllGites.forEach(swiper => {
  // faire une variable swiper + countSwiper
    let swiperGite = new Swiper('.gite-' + countSwiper, {
        modules: [Navigation, Pagination],
        loop: true,
        navigation:{
            nextEl: '.next-gite-' + countSwiper,
            prevEl: '.prev-gite-' + countSwiper,
        },
        pagination: {
            el: '.pagination-gite-' + countSwiper,
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 3

        },

    });
  countSwiper++;
})



