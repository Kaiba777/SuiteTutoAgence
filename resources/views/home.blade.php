@extends('base')

@section('content')

    <x-alert type="success">
        Des informations
    </x-alert>  

    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Agence lorem ipsum</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro delectus ullam, quas explicabo necessitatibus pariatur voluptas doloribus? Aperiam iure at ea ipsa alias doloribus possimus illo asperiores inventore modi. Suscipit!</p>
        </div>
    </div>

    <div class="container">
        <h2>Nos derniers biens</h2>
        <div class="row">
            @foreach ($properties as $property)
            <div class="col">
                @include('property.card')
            </div>
            @endforeach
        </div>
    </div>
@endsection