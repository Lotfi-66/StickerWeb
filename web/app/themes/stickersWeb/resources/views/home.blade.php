{{--
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
<div class="home-container">
  <div id="threejs-container"></div>
  <div class="content-overlay">
    <h1>Bienvenue sur B-NOW</h1>
    <p>Découvrez notre logo animé en 3D</p>
  </div>
</div>
@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Assurez-vous que ces fonctions sont définies dans votre fichier main.js
  if (typeof init === 'function' && typeof animate === 'function') {
    init();
    animate();
  } else {
    console.error('Les fonctions init ou animate ne sont pas définies.');
  }
});
</script>
@endsection