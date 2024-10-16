{{-- 
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
<div class="home-container">
  <div id="threejs-container"></div>
  <div class="content-overlay">
    @include('partials.page-header')

    @if (! have_posts())
      <x-alert type="warning">
        {!! __('Sorry, no results were found.', 'sage') !!}
      </x-alert>

      {!! get_search_form(false) !!}
    @endif

    @while(have_posts()) @php(the_post())
      @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
    @endwhile

    {!! get_the_posts_navigation() !!}
  </div>
</div>
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection

{{-- @section('scripts')
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
@endsection --}}