@extends('layouts.app')
@section('con')
    <div class="card card-default">
        <div class="card-header">Edit Tag</div>
        @include('errors')
        <div class="card-body">
            <form action="{{ route('tags.update', $tag->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text"
                    class="form-control" name="name" value="{{ $tag->name }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Tag</button>
                </div>
            </form>
        </div>
    </div>
@endsection