@extends('layouts.basic')

@section('content')

    @include('main.includes.nav')

    <div class="container">

        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Post</h3>
                </div>

                <div class="card-body">

                    <form role="form" action="{{ route('post.store') }}" enctype="multipart/form-data" method="post">
{{--                    <form role="form" action="{{ route('post.store') }}" method="post">--}}

                        @csrf

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Category</label>

                                    @if(count($categories) > 0)
                                        <select class="form-control" name="category_id">
                                            @foreach($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>content</label>
                                    <textarea name="content" type="text" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
{{--                                <div class="input-group is-invalid">--}}
{{--                                    <div class="custom-file">--}}
{{--                                        <input name="image" type="file" class="custom-file-input" required>--}}
{{--                                        <label class="custom-file-label" >Choose image file</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="image">Image file input</label>
                                    <input name="image"  type="file" class="form-control-file" id="image">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">CREATE</button>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection
