{{--
  Template Name: Nos Gîtes
--}}

@extends('layouts.app')
@section('content')

  <?php
  // récupère les gîtes
  $gites = get_posts(['post_type' => 'gites', 'orderby' => 'rand', 'posts_per_page' => 9]);
  ?>
  <section class="gites">
    <h1 class="gites__title">Nos gîtes</h1>
    <div class="gites__container" data-aos="fade-right">
    @php($count = 0)
    @foreach($gites as $gite)
      <article class="gite-card @if($count % 2 != 0) reverse @endif" >
        <div class="bubble-text">
          <h2 class="h1">{{ $gite->post_title }}</h2>
          <p class="strong">Jusqu'à {{ get_field('nombre_de_personne', $gite->ID) }} personnes</p>
          {!! get_field('resume_du_gite', $gite->ID) !!}
          <a href="{{ get_permalink($gite->ID) }}" class="btn light">En savoir +</a>
        </div>
        <div class="img-clip picture">
          <div class="swiper-container">
            <div class="swiper gite-{{ $count }}">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img src="{{ get_the_post_thumbnail_url($gite->ID) }}" alt="{{ $gite->post_title }}">
                </div>
                @php($photos = get_field('photos_du_gite', $gite->ID))
                @foreach($photos as $photo)
                  <div class="swiper-slide">
                    <img src="{{ $photo['image']['url'] }}" alt="{{ $photo['image']['alt'] }}">
                  </div>
                @endforeach
              </div>
              <div class="swiper-button-next next-gite-{{ $count }}" data-aos="fade-right"></div>
              <div class="swiper-button-prev prev-gite-{{ $count }}" data-aos="fade-left"></div>
              <div class="swiper-pagination pagination-gite-{{ $count }}" data-aos="fade-up"></div>
            </div>
          </div>
        </div>
      </article>
      @php($count++)
    @endforeach
    </div>

  </section>

@endsection
