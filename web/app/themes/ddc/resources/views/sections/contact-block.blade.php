<section class="contact" >
  <div class="wave top">
    <svg>
      <use xlink:href="<?= @asset('images/svg/waves.svg')->uri() ?>#wave-container"></use>
    </svg>
  </div>

  <div class="contact__content">
    <h1 data-aos="fade-right">{{ $title }}</h1>
    <div data-aos="fade-right">
    {!!  do_shortcode('[contact-form-7 id="5fa89e9" title="Formulaire de contact"]') !!}
    </div>
  </div>
  <div class="wave bottom">
    <svg>
      <use xlink:href="<?= @asset('images/svg/waves.svg')->uri() ?>#wave-container"></use>
    </svg>
  </div>
</section>
