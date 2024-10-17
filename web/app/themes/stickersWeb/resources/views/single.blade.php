@extends('layouts.app')

@section('title', get_the_title())

@section('content')
    <div class="single-post">
        <h1>{{ get_the_title() }}</h1>
        <div>
            {!! the_content() !!}
        </div>
        @include('partials.comments')
    </div>
@endsection
