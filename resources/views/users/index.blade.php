@extends('layouts.app')
@section('con')
    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
            @if ($users->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <img src="{{ Gravatar::src($user->email) }}" alt="" srcset=""
                                width="40px" height="40px" style="border-radius:50%">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>
                                {{ $user->email }}
                            </td>                            
                            <td>
                                    @if (!$user->isAdmin())
                                        <form action="{{ route('users.admin', $user->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-success btn-sm" type="submit">Make Admin</button>
                                        </form>
                                    @endif
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
            </table>
            @else
                <h3 class="text-center">
                    No Posts Yet.
                </h3>
            @endif
        </div>
    </div>
@endsection