{{--
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
<div class="home-container">
  <div id="threejs-container"></div>
  <div class="content-overlay">
    @while(have_posts()) @php(the_post())
      @include('partials.page-header')
      @includeFirst(['partials.content-page', 'partials.content'])
    @endwhile
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