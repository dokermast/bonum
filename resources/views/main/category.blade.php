@extends('layouts.basic')

@section('content')

    @include('main.includes.nav')

    <div class="container">

        @include('main.includes.buttons')

        <div class="text-center"><h3>{{ $category->name }}</h3></div>

        <div class="container">

            @if($posts && count($posts) > 0 )

                @foreach($posts as $item)

                    @include('main.includes.posts')
                @endforeach

                @include('main.includes.pagination')
            @else
            <div class="text-center"><h5> no posts </h5></div>
            @endif

        </div>

    </div>

@endsection

