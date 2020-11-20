@extends('admin.admin_basic')

@section('content')

    <div class="container">

        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Post</h3>
                </div>

                <div class="card-body">

                    <form role="form" action="{{ route('admin.post.update', $post) }}" enctype="multipart/form-data" method="post">

                        @csrf

                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" type="text" class="form-control" value="{{$post->title}}">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Category</label>

                                    @if(count($categories) > 0)
                                        <select class="form-control" name="category_id">
                                            <option value="{{$post->category->id}}">{{$post->category->name}}</option>
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
                                    <textarea name="content" type="text" class="form-control">{{$post->content}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group is-invalid">
                                    <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input">
                                        <label class="custom-file-label">Choose image file</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>


    </div>

@endsection
