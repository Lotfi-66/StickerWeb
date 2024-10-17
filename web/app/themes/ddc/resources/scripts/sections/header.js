const burger = document.querySelector('#header-burger');

console.log(burger);

burger.addEventListener('click', () => {
    console.log('clicked');
    document.querySelector('header').classList.toggle('open-menu');

  });

