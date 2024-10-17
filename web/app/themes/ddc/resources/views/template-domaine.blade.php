{{--
  Template Name: Le domaine
--}}

@php
  $id = get_the_ID();
@endphp

@extends('layouts.app')
@section('content')
  @include('sections.presentation-text')

  <section class="second-part">
    <div class="bubble-text">
      <h2 class="h1">{{ the_field('titre_h2', $id) }}</h2>
      {{ the_field('texte_dans_la_bulle', $id) }}
      @php($link = get_field('lien_dans_la_bulle', $id))
      <a href="{{ $link['url'] }}" class="btn light">{{ $link['title'] }}</a>
    </div>

    @php($imgs = get_field('images_dans_la_bulle', $id))
    <div class="image-part img-clip picture">
      <div class="swiper-container ">
        <div class="swiper swiper-domaine">
          <div class="swiper-wrapper">
            @foreach($imgs as $img)
              <div class="swiper-slide">
                <a href="{{ $img['image']['url'] }}" class="glightbox">
                  <img src="{{ $img['image']['url'] }}" alt="{{ $img['image']['alt'] }}" loading="lazy">
                </a>
              </div>
            @endforeach
          </div>
          <div class="swiper-button-next next" data-aos="fade-right"></div>
          <div class="swiper-button-prev prev" data-aos="fade-left"></div>
          <div class="swiper-pagination pagination-gite" data-aos="fade-up"></div>
        </div>
      </div>

    </div>
  </section>

@endsection
