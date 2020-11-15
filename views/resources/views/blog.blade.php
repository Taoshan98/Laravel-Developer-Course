@extends('template.layout')
@section('title', 'Blog')

@section('content')
    <h1>Blog</h1>

    @component('components.card', ['imgTitle' => "Image Blog", 'imgUrl' => "https://picsum.photos/300/200"])
        <p>Ches bella immagine</p>
    @endcomponent

    @component('components.card')
        @slot('imgUrl', "https://picsum.photos/300/200")
        @slot('imgTitle', "Image Blog")
        <p>Ches bella immagine 2</p>
    @endcomponent
@endsection

@include('components.card', ['imgTitle' => "Image Blog", 'imgUrl' => "https://picsum.photos/300/200"])

