@extends('layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success')}}
        </div>
    @endif

    <div>
        <a class="btn btn-success" href="{{ route('users.create') }}">Add User</a>
    </div>

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>User Age</th>
            <th>Actions</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{$user->age }}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('users.edit', ['id' => $user->id]) }}">Edit</a>
                    <a class="btn btn-danger" href="{{ route('users.destroy', ['id' => $user->id]) }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection