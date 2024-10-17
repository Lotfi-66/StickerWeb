{{--
  Template Name: Home
--}}

@extends('layouts.app')
@section('content')
  @include('sections.presentation-text')

  @php
    $gites = get_posts(['post_type' => 'gites', 'posts_per_page' => 9]);
//        dd($gites);
  @endphp
  <section class="gites">
    <h2 class="gites__title h1">Nos gîtes</h2>
    <div class="pagination-gite"></div>
    <div class="gites__container" data-aos="fade-right">
      <div class="swiper swiper-gite">
        <div class="swiper-wrapper">
          @foreach($gites as $gite)
            <div class="swiper-slide">
              <article class="gite-card">
                <div class="bubble-text">
                  <h3 class="h1 light">{{ $gite->post_title }}</h3>
                  <p class="strong">Jusqu'à {{ get_field('nombre_de_personne', $gite->ID) }} personnes</p>
                  {!! get_field('resume_du_gite', $gite->ID) !!}
                  <a href="{{ get_permalink($gite->ID) }}" class="btn light">En savoir +</a>
                </div>
                <div class="img-clip picture">
                  <img src="{{ get_the_post_thumbnail_url($gite->ID) }}" alt="{{ $gite->post_title }}">
                </div>
              </article>
            </div>
          @endforeach
        </div>
        <div class="swiper-button-next next-gite"></div>
        <div class="swiper-button-prev prev-gite"></div>
      </div>
    </div>
  </section>



  @php
    $activities = get_posts(['post_type' => 'Lieux', 'orderby' => 'rand', 'posts_per_page' => 9])
  @endphp
  @if(have_posts($activities))
    <section class="places">
      <div class="wave top">
        <svg>
          <use xlink:href="<?= @asset('images/svg/waves.svg')->uri() ?>#wave-container"></use>
        </svg>
      </div>
      <div class="places__content">
        <div class="places__content__element" data-aos="fade-up">
          <h2 class="h1 light">Découvrez la région</h2>
          <div class="swiper-container">
            <div class="swiper-button-next next-activity" data-aos="fade-right"></div>
            <div class="swiper-button-prev prev-activity" data-aos="fade-left"></div>
            <div class="swiper swiper-activity">
              <div class="swiper-wrapper">
                @foreach($activities as $activityPost)
                  <div class="swiper-slide">
                    <div class="card-activity">
                      <div class="img-clip" style="width: 200px; height: 200px">
                        @php
                          $image = get_field('image_de_lactivite', $activityPost->ID);
                        @endphp
                        <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
                      </div>
                      <div class="places__content__place__text">
                        <p>{{ get_the_title($activityPost->ID) }}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="swiper-pagination pagination-activity"></div>
          </div>
          <a href="{{ get_field('lien_menu_3', 'option')['url'] }}#main" class="btn light mt-3">
            En savoir +
          </a>
        </div>
      </div>


      <div class="wave bottom">
        <svg>
          <use xlink:href="<?= @asset('images/svg/waves.svg')->uri() ?>#wave-container"></use>
        </svg>
      </div>
    </section>
  @endif
  <div class="leaf">
    <svg>
      <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#leaf"></use>
    </svg>
    <svg>
      <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#leaf"></use>
    </svg>
  </div>


  @include('sections.faq')



  @include('sections.contact-block', ['title' => 'Une Question ?'])
@endsection
