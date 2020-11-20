<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card" style="max-width: 100%;">
            <div class="row no-gutters">
                <div class="col-md-2">
                    @if($item->img)
                        <img src="{{asset('/storage/public/'.$item->img)}}" class="card-img" alt="">
                    @else
                        <img src="/public/img/default.jpeg" class="card-img" alt="">
                    @endif
                </div>
                <div class="col-md-10">
                    <div class="card-body">

                        @if($item->category->parent)
                            <h5 class="card-title"><a href="{{route('category.posts', $item->category->parent->id)}}">Parent Category: {{ $item->category->parent->name }}</a></h5>
                        @endif
                        <h5 class="card-title"><a href="{{route('category.posts', $item->category->id)}}">Category: {{ $item->category->name }}</a></h5>
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{$item->content}}</p>

                        @auth
                            @if(Auth()->user()->id == $item->user->id)
                                <form action="{{ route('post.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?')" title="Delete">Delete</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
<br>
