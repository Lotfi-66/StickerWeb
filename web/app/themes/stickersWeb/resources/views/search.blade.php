{{--
  Template Name: Search Results
--}}

@extends('layouts.app')

@section('content')
<div class="search-container">
  <div id="threejs-container"></div>
  <div class="content-overlay">
    @include('partials.page-header')

    @if (! have_posts())
      <x-alert type="warning">
        {!! __('Sorry, no results were found.', 'sage') !!}
      </x-alert>

      {!! get_search_form(false) !!}
    @else
      <div class="search-results">
        @while(have_posts()) @php(the_post())
          @include('partials.content-search')
        @endwhile
      </div>

      <div class="pagination">
        {!! get_the_posts_navigation() !!}
      </div>
    @endif
  </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof init === 'function' && typeof animate === 'function') {
    init();
    animate();
  } else {
    console.error('Les fonctions init ou animate ne sont pas définies.');
  }
});
</script>
@endsection