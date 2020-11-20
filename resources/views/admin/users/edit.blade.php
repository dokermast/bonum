@extends('admin.admin_basic')

@section('content')

    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create User</h3>
            </div>

            <div class="card-body">

                @if(isset($user))

                <form role="form" action="{{ route('user.update', $user) }}" method="post">
                    @csrf
                    {{-- LOGIN NAME--}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Login</label>
                                <input name="login" type="text" class="form-control" value="{{$user->login}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control" value="{{$user->name}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Second Name  Birthday --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Second Name</label>
                                <input name="second_name" type="text" class="form-control" value="{{$user->second_name}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Birthday</label>
                                    <input name="birthday" type="date" class="form-control" value="{{$user->birthday}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Role</label>
                            @if($roles && count($roles) > 0)
                                <div class="form-group">
                                    <select class="form-control" name="role_id">
                                        <option value="{{$user->role_id}}" selected>{{$user->role->name}}</option>
                                        @foreach($roles as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Password  Confirm --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password_confirmation" type="password" class="form-control">
                                </div>
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
