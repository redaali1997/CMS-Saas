@extends('layouts.app')
@section('con')
    <div class="card card-default">
        <div class="card-header">Create Tag</div>
        @include('errors')
        <div class="card-body">
            <form action="{{ route('tags.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text"
                    class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add Tag</button>
                </div>
            </form>
        </div>
    </div>
@endsection