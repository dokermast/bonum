@extends('layouts.basic')


@section('content')

    @include('main.includes.nav')

    <div class="container">

        @include('main.includes.buttons')

        <div class="text-center"><h3>CHOOSE CATEGORY</h3></div>

        <div class="container cat">

            @if(count($categories) > 0 )
                <ul>
                    @foreach($categories as $item)
                        @if($item->parent_id == 0)
                            <li><a class="" href="{{route('category.posts', $item)}}">{{$item->name}}</a></li>
                            <ul>
                                @foreach($item->child as $el)
                                    <li><a class="" href="{{route('category.posts', $el)}}">{{$el->name}}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </ul>
            @else
                <div class="text-center"><h5> no categories </h5></div>
            @endif

        </div>

    </div>

@endsection
