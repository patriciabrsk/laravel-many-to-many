
@extends('layouts.app')

@section('content')
    <div class="wrapper w-75 mx-auto">
        <div class="container-fluid">
            <div class="row p-4">
                {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
            </div>
            <div class="row p-4">

                <form action="{{ route('admin.posts.update', $post) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{$post->title}}">
                        <div id="titleHelp" class="form-text">Insert title</div>
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_url">Image URL</label>
                        <select class="form-select" name="category">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    @if ($post->categories[0]->id === $category->id ) selected @endif>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="mb-3">
                        <label for="image_url">Image URL</label>
                        <input type="text" name="image_url" id="image_url" value="{{$post->image_url}}">
                        @error('image_url')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">

                        <label for="content" class="form-label">Insert post content</label>
                        <textarea class="form-control" id="content" rows="10" name="content" id="content">
                            {{$post->content}}
                        </textarea>
                        @error('content')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Edit post</button>
                </form>

            </div>
        </div>
    </div>
@endsection