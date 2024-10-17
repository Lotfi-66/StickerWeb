import domReady from '@roots/sage/client/dom-ready';
import '../images/svg/icon.svg';
import './sections/header.js';
import AOS from 'aos';
import 'aos/dist/aos.css';

/**
 * Application entrypoint
 */
domReady(async() => {
  // ...
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) {
    import.meta.webpackHot.accept(console.error);
}

// l'extension qui permet de faire des animations scroll en js
document.addEventListener('DOMContentLoaded', function () {
    AOS.init();
});
