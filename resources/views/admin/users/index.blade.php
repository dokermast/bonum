@extends('admin.admin_basic')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <div class="card-tools">
                            <a href="{{ route('user.create') }}" class="btn btn-primary">Add User</a>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        @if(count($users) > 0)
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>role</th>
                                    <th>login</th>
                                    <th>name</th>
                                    <th>second name</th>
                                    <th>birthday</th>
                                    <th>email</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->role->name }}</td>
                                        <td>{{ $item->login }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->second_name }}</td>
                                        <td>{{ $item->birthday }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td><a class="btn btn-outline-warning" href="{{ route('user.edit', $item) }}">Edit</a></td>
                                        <td>
                                            <form action="{{ route('user.destroy', $item) }}" method="POST">
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
                            <div class="text-center"><h5> no users </h5></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
