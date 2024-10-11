{{--
  Template Name: Single Post
--}}

@extends('layouts.app')

@section('content')
<div class="single-post-container">
  <div id="threejs-container"></div>
  <div class="content-overlay">
    @while(have_posts()) @php(the_post())
      @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
    @endwhile
  </div>
</div>
@endsection

@section('styles')
<style>
  .single-post-container {
    position: relative;
    min-height: 100vh;
    width: 100%;
    overflow: hidden;
    background-color: #f5f5f5;
  }

  #threejs-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
  }

  .content-overlay {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    margin: 2rem auto;
    max-width: 800px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  @media (min-width: 768px) {
    .content-overlay {
      margin: 4rem auto;
    }
  }

  .entry-header {
    margin-bottom: 2rem;
  }

  .entry-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
  }

  .entry-meta {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 1rem;
  }

  .entry-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #444;
  }

  .entry-content p,
  .entry-content ul,
  .entry-content ol {
    margin-bottom: 1.5rem;
  }

  .entry-content h2,
  .entry-content h3,
  .entry-content h4 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #333;
  }

  .entry-footer {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
    font-size: 0.9rem;
    color: #666;
  }
</style>
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