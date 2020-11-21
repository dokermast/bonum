@extends('admin.admin_basic')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories</h3>
                        <div class="card-tools">
                            <a href="{{ route('category.create') }}" class="btn btn-primary">Add Category</a>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        @if(count($categories) > 0)
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>parent</th>
                                    <th>name</th>
                                    <th>slug</th>
                                    <th>status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        @if($item->parent)
                                        <td>{{ $item->parent->name }}</td>
                                        @else
                                        <td>main</td>
                                        @endif
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>
                                            @if($item->status == 0)
                                                <a id="off_{{$item->id}}" style="" class="btn btn-secondary btn-sm" onclick="categoryStatus({{$item->id}}, 1)">Off</a>
                                                <a id="on_{{$item->id}}" style="display: none" class="btn btn-success btn-sm" onclick="categoryStatus({{$item->id}}, 0)">On</a>
                                            @else
                                                <a id="on_{{$item->id}}" style="" class="btn btn-success btn-sm" onclick="categoryStatus({{$item->id}}, 0)">On</a>
                                                <a id="off_{{$item->id}}" style="display: none" class="btn btn-secondary btn-sm" onclick="categoryStatus({{$item->id}}, 1)">Off</a>
                                            @endif
                                        </td>
                                        <td><a class="btn btn-outline-warning" href="{{ route('category.edit', $item) }}">Edit</a></td>
                                        <td>
                                            <form action="{{ route('category.destroy', $item->id) }}" method="POST">
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
                            <div class="text-center"><h5> no categories </h5></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.includes.categories_script')
@endsection
