@extends('admin.admin_basic')

@section('content')

    <!-- right column -->
    <div class="col-md-12">

        <!-- general form elements disabled -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Category</h3>
            </div>

            <div class="card-body">

                <form role="form" action="{{ route('category.store') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Category name</label>
                                <input name="name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-5">

                            @if(count($categories) > 0)
                                <div class="form-group">
                                    <label>Parent</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="0" selected>parent</option>
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
                                    <option value="1">ON</option>
                                    <option value="0">OFF</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">CREATE</button>
                </form>
            </div>
        </div>
    </div>

@endsection
