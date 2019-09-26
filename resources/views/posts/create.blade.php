@extends('layouts.app')
@section('con')
    <div class="card card-default">
        <div class="card-header">{{ isset($post) ? 'Edit Post' : 'Create Post' }}</div>
        @include('errors')
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($post)
                    @method('PATCH')
                @endisset
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text"
                    class="form-control" name="title" id="title" value="{{ isset($post) ? $post->title : old('title') }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description">{{ isset($post) ? $post->description : old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : old('content') }}">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text"
                      class="form-control" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at : old('published_at') }}">
                </div>
                @isset($post)
                    <div class="form-group">
                        <img src="{{ asset('/storage/'.$post->image) }}" width="500px" height="500px">
                    </div>
                @endisset

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file"
                      class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if (isset($post))
                                        @if ($category->id == $post->category_id)
                                        selected
                                        @endif
                                    @endif
                                    >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if (isset($tags))
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select name="tags[]" id="tags" class="form-control js-example-basic-multiple" multiple>
                        @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                        @if (isset($post))
                                            @if ($post->hasTag($tag->id))
                                                selected
                                            @endif
                                        @endif
                                    >{{ $tag->name }}</option>
                        @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{ isset($post) ? 'Update Post' : 'Add Post' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script>
        flatpickr("#published_at", {
            enableTime: true,
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
