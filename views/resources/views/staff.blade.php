@extends('template.layout')


@section('title', $title)
@section('content')
    <h1>
        <p>Blade View</p>
        <p>{{$title}}</p>
    </h1>

    <h3>Foreach Loop</h3>

    @if ($staff)
        <ul>
            @foreach ($staff as $person)
                <li style="{{$loop->first ? 'color:red;' : ''}}">{{$loop->remaining}} {{$person['name']}} {{$person['lastname']}}</li>
            @endforeach
        </ul>
    @else
        <p>No Staff</p>
    @endif

    <h3>ForElse Loop</h3>

    <ul>
        @forelse($staff as $person)
            <li>{{$person['name']}} {{$person['lastname']}}</li>
        @empty
            <li>No Staff</li>
        @endforelse

    </ul>

    <h3>For Loop</h3>
    <ul>
        @for($i = 0; $i < count($staff); $i++)

            <li>{{$staff[$i]['name']}} {{$staff[$i]['lastname']}}</li>
        @endfor
    </ul>

    <h3>While Loop</h3>
    <ul>
        @while($person = array_shift($staff))

            <li>{{$person['name']}} {{$person['lastname']}}</li>
        @endwhile
    </ul>
@endsection

{{--@section('footer')
    @parent <!-- senza parent sovrascrivo tutto il footer con parent invece eredito e aggiungo -->
    <script>
        alert('footer');
    </script>
@stop--}}

