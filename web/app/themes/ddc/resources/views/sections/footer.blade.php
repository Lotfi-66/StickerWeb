<footer class="content-info">

  <div class="footer__leafs">
    <svg>
      <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#leaf"></use>
    </svg>

    <svg>
      <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#leaf"></use>
    </svg>
  </div>

  <div class="footer__nous-retrouver">

    <p class="h1">Nous Retrouver</p>
    <div class="link-container">
      @php($maps = get_field('adresse', 'option'))
      @if($maps)
        <a href="{{ $maps['url'] }}" title="{{$maps['title']}}" target="{{$maps['target']}}" class="link">
          <svg>
            <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#maps"></use>
          </svg>
          <p>{{$maps['title']}}</p>
        </a>
      @endif

      @php($phone = get_field('numero_de_telephone', 'option'))
      @if($phone)
        @php($phoneLink = str_replace(' ', '', $phone))
        @php($phoneLink = substr($phoneLink, 1))
        <a href="tel:+33{{ $phoneLink }}" title="{{ $phone }}" class="link">
          <svg>
            <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#phone"></use>
          </svg>
          <p>{{ $phone }}</p>
        </a>
      @endif

      @php($mail = get_field('e-mail', 'option'))
      @if($mail)
        <a href="mailto:{{$mail}}" title="{{$mail}}" class="link">
          <svg>
            <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#mail"></use>
          </svg>
          <p>{{$mail}}</p>
        </a>
      @endif

    </div>
  </div>

  <nav class="footer__menu">
    <ul class="footer__menu--ul">
      @for($i = 1; $i <= 5; $i++)
          <?php $nav_link = get_field('lien_menu_' . $i, 'option') ?>
        @if($nav_link)
          <li><a href="{{ $nav_link['url'] }}">
              {{ $nav_link['title'] }}
            </a>
          </li>
        @endif
      @endfor
    </ul>
  </nav>

  @php($privacy_policy_page_id = 3)
  @php($terms_conditions_page_id = 164)
  @php($privacy_policy_url = get_permalink($privacy_policy_page_id))
  @php($terms_conditions_url = get_permalink($terms_conditions_page_id))

  <div class="mentions">
    <a href="{{ $terms_conditions_url }}" class="mentions__link">Mentions légales</a>
    <a href="{{ $privacy_policy_url }}" class="mentions__link">Politique de confidentialité</a>
    <a href="https://b-now.com/" class="mentions__link">©2024 Agence B-now</a>
  </div>



</footer>
