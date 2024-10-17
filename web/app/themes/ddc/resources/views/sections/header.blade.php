<header id="main-header">
  <div class="main-header__top">
    <div id="header-burger" class="burger">
      <span class="burger__line"></span>
      <span class="burger__line"></span>
    </div>
    <div class="social-container">
      <?php
      $mail = get_field('e-mail', 'option');
      $maps = get_field('adresse', 'option');
      $facebook = get_field('facebook', 'option');
      $phone = get_field('numero_de_telephone', 'option');
      // enlève les espaces et le premier 0 du numéro de téléphone
      $phoneLink = str_replace(' ', '', $phone);
      $phoneLink = substr($phoneLink, 1);
      ?>


      <a href="tel:+33{{ $phoneLink }}" title="{{ $phone }}" class="social-container__link">
        <svg class="social-container__icon">
          <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#phone"></use>
        </svg>
      </a>
      <a href="mailto:{{$mail}}" title="{{$mail}}" class="social-container__link">
        <svg class="social-container__icon">
          <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#mail"></use>
        </svg>
      </a>
      @if($maps['url'])
        <a href="{{ $maps['url'] }}" title="{{$maps['title']}}" target="{{$maps['target']}}"
           class="social-container__link">
          <svg class="social-container__icon">
            <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#maps"></use>
          </svg>
        </a>
      @endif
      @if($facebook['url'])
        <a href="{{ $facebook['url'] }}" title="{{$facebook['title']}}" target="{{$facebook['target']}}"
           class="social-container__link">
          <svg class="social-container__icon">
            <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#facebook"></use>
          </svg>
        </a>
      @endif
    </div>
  </div>
  <nav class="menu">
    <ul class="menu--ul">
      @for($i = 1; $i <= 5; $i++)
          <?php $link_1 = get_field('lien_menu_' . $i, 'option') ?>
        @if($link_1)
          <li class="menu__item menu__item-number-{{$i}}"><a href="{{ $link_1['url'] }}" title="{{ $link_1['title'] }}">
              {{ $link_1['title'] }}
            </a>
          </li>
        @endif
      @endfor
    </ul>
  </nav>

  <div class="main-header__bottom">
    <?php $headerPicture = get_field('image_den_tete_de_fond', 'option') ?>
    <img src="{{ $headerPicture['url'] }}" alt="{{ $headerPicture['alt'] }}" class="main-header__bottom--img ">


    <?php $homeLink = get_field('accueil', 'option'); ?>
    <div class="logo-container">
      <svg class="lines-for-links" viewBox="0 0 286 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M219 100L259 59H286" stroke="#C38C52" stroke-width="2"/>
        <path d="M67 100L27 59H0" stroke="#C38C52" stroke-width="2"/>
        <path d="M163 42L203 1H230" stroke="#C38C52" stroke-width="2"/>
        <path d="M123 42L83 1H56" stroke="#C38C52" stroke-width="2"/>
      </svg>
      <a href="{{ $homeLink['url'] }}" target="{{ $homeLink['target'] }}" title="{{ $homeLink['title'] }}" class="logo">
        <img src="{{ asset('../images/logo/logo.png') }}" alt="Logo Domaine du Consul">
      </a>
    </div>
  </div>


</header>


