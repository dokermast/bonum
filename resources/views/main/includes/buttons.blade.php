<div class="text-center">
    <a class="btn btn-outline-success" href="{{route('main')}}">Go to Main Page</a>
    <a class="btn btn-outline-success" href="{{route('main.categories')}}">Go to Categories</a>
    @auth
        @if( Auth()->user()->role_id == 2   ||  Auth()->user()->role_id == 1 )
                <a class="btn btn-outline-success" href="{{route('post.create')}}">Add post</a>
        @endif
    @endif
</div>
