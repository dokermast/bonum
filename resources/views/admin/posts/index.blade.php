@extends('admin.admin_basic')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Posts</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.post.create') }}" class="btn btn-primary">Add Post</a>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        @if(count($posts) > 0)
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>category</th>
                                    <th>author</th>
                                    <th>title</th>
                                    <th>content</th>
                                    <th>status</th>
                                    <th>removed</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->content }}</td>
                                        <td>
                                            @if($item->status == 0)
                                                <a id="off_{{$item->id}}" style="" class="btn btn-secondary btn-sm" onclick="postStatus({{$item->id}}, 1)">Off</a>
                                                <a id="on_{{$item->id}}" style="display: none" class="btn btn-success btn-sm" onclick="postStatus({{$item->id}}, 0)">On</a>
                                            @else
                                                <a id="on_{{$item->id}}" style="" class="btn btn-success btn-sm" onclick="postStatus({{$item->id}}, 0)">On</a>
                                                <a id="off_{{$item->id}}" style="display: none" class="btn btn-secondary btn-sm" onclick="postStatus({{$item->id}}, 1)">Off</a>
                                            @endif
                                        </td>
                                        <td>{{ $item->removed }}</td>
                                        <td><a class="btn btn-outline-warning" href="{{ route('admin.post.edit', $item->id) }}">Edit</a></td>

                                        <td>
                                            <form action="{{ route('admin.post.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?')" title="Delete">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center"><h5> no posts </h5></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.includes.posts_script')
@endsection
