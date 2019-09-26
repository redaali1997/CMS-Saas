@extends('layouts.app')
@section('con')
@if (auth()->user()->isAdmin())
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
</div>
@endif
<div class="card card-default">
    <div class="card-header">Categories</div>
    <div class="card-body">
        @if ($categories->count() > 0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Posts Count</th>
                @if (auth()->user()->isAdmin())
                <th></th>
                @endif
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>
                        {{ $category->name }}
                    </td>
                    <td>
                        {{ $category->posts()->count() }}
                    </td>
                    @if (auth()->user()->isAdmin())
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">
                            Edit
                        </a>
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})">
                            Delete
                        </button>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h3 class="text-center">
            No Categories Yet.
        </h3>
        @endif

        <form action="" method="post" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure to delete this category ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back!</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function handleDelete(id){
            var form = document.getElementById('deleteForm')
            form.action = '/categories/' + id
            $('#deleteModal').modal('show')
        }
</script>
@endsection
