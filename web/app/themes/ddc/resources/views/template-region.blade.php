{{--
  Template Name: Région
--}}

@extends('layouts.app')
@section('content')

  @include('sections.presentation-text')

  <section class="places light">
    <div class="wave top">
      <svg>
        <use xlink:href="<?= @asset('images/svg/waves.svg')->uri() ?>#wave-container"></use>
      </svg>
    </div>
    <div class="places__content">
      <div class="leaf">
        <svg>
          <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#leaf"></use>
        </svg>
        <svg>
          <use xlink:href="<?= @asset('images/svg/icon.svg')->uri() ?>#leaf"></use>
        </svg>
      </div>
      @php
        $args = array(
          'post_type' => 'Lieux',
          'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        // récupère les catégories
        $categories = get_terms(array(
          'taxonomy' => 'categorie-dactivite',
          'hide_empty' => true,
          // trier par terme id
          'orderby' => 'term_id',
          'order' => 'ASC'
        ));
        $count = 0;
      @endphp
      @foreach($categories as  $category)
        <div class="places__content__element" data-aos="fade-up">
          <h2 class="h1 light">{{ $category->name }}</h2>
          @if($category->count > 1)
            <div class="swiper-container">
              <div class="swiper swiper-{{ $count }}">
                <div class="swiper-wrapper">
                  @endif
                  @foreach($query->posts as $post)
                      <?php $postCategory = get_the_terms($post->ID, 'categorie-dactivite') ?>
                    @if($postCategory[0]->name == $category->name)
                      <div class="swiper-slide">
                        <div class="card-activity">
                          <div class="img-clip" style="width: 200px; height: 200px">
                            @php $image = get_field('image_de_lactivite', $post->ID) @endphp
                            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
                          </div>
                          <div class="places__content__place__text">
                            <p>{{ get_the_title($post->ID) }}</p>
                          </div>
                        </div>
                      </div>
                    @endif
                  @endforeach
                  @if($category->count > 1)
                </div>
              </div>
              <div class="swiper-button-next next-{{ $count }}" data-aos="fade-right"></div>
              <div class="swiper-button-prev prev-{{ $count }}" data-aos="fade-left"></div>
              <div class="swiper-pagination pagination-{{ $count }}"></div>
            </div>

            @php $count++; @endphp
          @endif
        </div>
      @endforeach
    </div>

    <div class="wave bottom">
      <svg>
        <use xlink:href="<?= @asset('images/svg/waves.svg')->uri() ?>#wave-container"></use>
      </svg>
    </div>
  </section>

@endsection
