@extends('layouts.app')
@section('con')
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
</div>
<div class="card card-default">
    <div class="card-header">
        Posts
    </div>
    <div class="card-body">
        @if ($posts->count() > 0)
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                <tr>
                    <td>
                        <img src="{{ asset('/storage/'.$post->image) }}" width="100px" height="75px">
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $post->category->id) }}">{{ $post->category->name }}</a>
                    </td>
                    @if (!$post->trashed())
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">
                            Edit
                        </a>

                    </td>
                    <td>
                        @if (auth()->user()->isAdmin() && $post->accepted == false)
                        <form action="{{ route('post.accept', $post->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">
                                Accept
                            </button>
                        </form>
                        @endif
                    </td>
                    @else
                    <td>
                        <form action="{{ route('restore-post', $post->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-info btn-sm">
                                Restore
                            </button>
                        </form>
                    </td>
                    @endif
                    <td>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            @if ($post->trashed())
                            <button class="btn btn-danger btn-sm" type="submit">
                                Delete
                            </button>
                            @else
                            <button class="btn btn-danger btn-sm" type="submit">
                                Trash
                            </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach

                {{-- @foreach ($posts as $post)
                <tr>
                    <td>
                        <img src="{{ asset('/storage/'.$post->image) }}" width="100px" height="75px">
                </td>
                <td>{{ $post->title }}</td>
                <td>
                    <a href="{{ route('categories.edit', $post->category->id) }}">{{ $post->category->name }}</a>
                </td>
                @if (!$post->trashed())
                <td>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">
                        Edit
                    </a>
                </td>
                @else
                <td>
                    <form action="{{ route('restore-post', $post->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info btn-sm">
                            Restore
                        </button>
                    </form>
                </td>
                @endif
                <td>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        @if ($post->trashed())
                        <button class="btn btn-danger btn-sm" type="submit">
                            Delete
                        </button>
                        @else
                        <button class="btn btn-danger btn-sm" type="submit">
                            Trash
                        </button>
                        @endif
                    </form>
                </td>
                </tr>
                @endforeach --}}

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
