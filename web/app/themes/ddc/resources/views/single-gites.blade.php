@extends('layouts.app')

@section('content')
  <section class="first-part">
    <div class="text-part">
      <h1>{{ the_title() }}</h1>
      <div class="reservation">
        @php($calendar = get_field('short_code_du_calendrier'))
        {!! do_shortcode($calendar) !!}
      </div>
    </div>
    <div class="img-clip picture">
      <div class="swiper-container">
        <div class="swiper gite-photos">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <a href="{{ get_the_post_thumbnail_url() }}" class="glightbox">
                <img src="{{ get_the_post_thumbnail_url() }}" alt="{{ the_title() }}">
              </a>
            </div>
            @php($photos = get_field('photos_du_gite'))
            @if($photos)
              @foreach($photos as $photo)
                <div class="swiper-slide">
                  <a href="{{ $photo['image']['url'] }}" class="glightbox" data-360="false">
                    <img src="{{ $photo['image']['url'] }}" alt="{{ $photo['image']['alt'] }}">
                  </a>
                </div>
              @endforeach
            @endif
            @php($photos360 = get_field('photos_360'))
            @if($photos360)
              @foreach($photos360 as $photo360)
                <div class="swiper-slide">
                  <a href="/360-image-viewer/?image={{ $photo360['image_360']['url'] }}" class="img-360" data-src="{{ $photo360['image_360']['url'] }}" target="_blank">
                    <img src="{{ asset('../images/jpg/360_img.jpg') }}" alt="image 360">
                    <p>test</p>
                  </a>
                </div>
              @endforeach
            @endif
            <div>
            </div>
          </div>
          <div class="swiper-button-next next-gite" data-aos="fade-right"></div>
          <div class="swiper-button-prev prev-gite" data-aos="fade-left"></div>
          <div class="swiper-pagination pagination-gite" data-aos="fade-up"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="detail">
    <div class="wave top">
      <svg>
        <use xlink:href="<?= @asset('images/svg/waves.svg')->uri() ?>#wave-container"></use>
      </svg>
    </div>
    <div class="detail__content">
      <div class="description">
        <h2 class="h1 light">Détails de l'hébergement</h2>
        {{ the_field('details_de_l’hebergement') }}
      </div>
      @php($equipements = get_field('equipements'))
      @if($equipements)
        <div class="equipements">
          <h2 class="h1 light">Équipements</h2>
          <div class="equipements__container">

            @foreach($equipements as $equipement)
              <div class="equipement">
                <img src="{{ $equipement['icon']['url'] }}" alt="{{ $equipement['icon']['url'] }}">
                <p>{{ $equipement['equipement'] }}</p>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </div>
    <div class="wave bottom">
      <svg>
        <use xlink:href="<?= @asset('images/svg/waves.svg')->uri() ?>#wave-container"></use>
      </svg>
    </div>
  </section>

  @include('sections.faq')
@endsection
