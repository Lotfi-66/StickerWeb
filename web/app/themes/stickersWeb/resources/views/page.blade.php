<!-- resources/views/page.blade.php -->
@extends('layouts.app') <!-- Étend le layout principal -->

@section('content')
    <h1>Bienvenue sur notre site !</h1>
    <p>Voici les stickers que nous proposons :</p>
    
    <div id="app">
        <!-- Ajoute des éléments ici -->
        <div class="logo-item">
            <a href="#">
                <canvas></canvas>
                <div class="logo-name">Sticker 1</div>
            </a>
        </div>
        <!-- Ajoute plus de logos ici si nécessaire -->
    </div>
@endsection
