@extends('template.layout')

@section('content')

    <h1> <p>Blade View</p> </h1>

    <div class="content">
        <x-alert class="text-muted" :name="$name"></x-alert>

        <x-alert style="color: green;">
            @slot('info',  'danger')
            @slot('name',  'Nunzio')
            @slot('message',  'Attenzione')
        </x-alert>

        {{--@component('components.alert')
            @slot('info',  'warning')
            @slot('name',  'Nunzio')
            @slot('message',  'Pericolo')
        @endcomponent--}}
    </div>

@endsection
