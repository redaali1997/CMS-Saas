@extends('layouts.app')
@section('con')
    <div class="card card-default">
        <div class="card-header">Edit Category</div>
        @include('errors')
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text"
                    class="form-control" name="name" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection