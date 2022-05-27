
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

                <form action="{{ route('admin.categories.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="me-2">New topic</label>
                        <input type="text" name="name" id="name">
                        <!-- <div id="nameHelp" class="form-text">Add</div> -->
                        @error('name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="color" class="mb-2">Pick a color</label>
                        <input type="color" class="form-control form-control-color" id="color" value="#00000" title="Select a color for new topic" name="color">
                        @error('color')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary text-white">Add</button>
                </form>

            </div>
        </div>
    </div>
@endsection