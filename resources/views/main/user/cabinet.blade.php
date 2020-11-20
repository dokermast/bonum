@extends('layouts.basic')

@section('content')

    @include('main.includes.nav')

    <div class="container">

        @if(Auth()->user()->role_id == 2   ||  Auth()->user()->role_id == 1 )
            <div class="text-center">
                <a class="btn btn-outline-success" href="{{route('post.create')}}">Add post</a>
            </div>
        @endif



    </div>

@endsection
