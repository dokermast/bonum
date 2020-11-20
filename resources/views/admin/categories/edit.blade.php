@extends('admin.admin_basic')

@section('content')

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
            </div>

            <div class="card-body">

                @if(isset($category))

                    <form role="form" action="{{ route('category.update', $category) }}" method="post">
                        @csrf

                        <div class="row">
                            {{-- NAME --}}
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Category name</label>
                                    <input name="name" type="text" class="form-control" value="{{ $category->name }}">
                                </div>
                            </div>

                            <div class="col-sm-5">

                                @if(count($categories) > 0)
                                    <div class="form-group">
                                        <label>Parent</label>
                                        <select class="form-control" name="parent_id">
                                            @if($category->parent)
                                            <option value="{{$category->parent->id}}" selected>{{ $category->parent->name }}</option>
                                            @else
                                            <option value="0">main</option>
                                            @endif
                                            @foreach($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                @endif

                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="{{$category->status}}" selected>@if($category->status == 0) OFF @else ON @endif</option>
                                        <option value="1">ON</option>
                                        <option value="0">OFF</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>

                @endif
            </div>
        </div>
    </div>

@endsection
