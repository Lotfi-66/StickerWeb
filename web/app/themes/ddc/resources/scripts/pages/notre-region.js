import Swiper from "swiper";
import { Navigation, Pagination} from "swiper/modules";
import 'swiper/css/bundle';
import 'swiper/css/navigation';


// initialisation du premier swiper

const AllSwipers = document.querySelectorAll('.swiper');

    let countSwiper = 0;
AllSwipers.forEach(swiper => {
    // faire une variable swiper + countSwiper
    let swiperTest = new Swiper('.swiper-' + countSwiper, {
        modules: [Navigation, Pagination],
        loop: true,
        navigation:{
            nextEl: '.next-' + countSwiper,
            prevEl: '.prev-' + countSwiper,
        },
        pagination: {
            el: '.pagination-' + countSwiper,
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
    countSwiper++;
})



