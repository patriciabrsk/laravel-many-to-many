
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

                {{-- ? Per ogni valore rilevante ai fini del salvataggio abbiamo creato: --}}
                {{-- # Un campo modificabile (tipicamente un input) in cui l'utente può inserire i contenuti --}}
                {{-- § Un attributo del campo relativo di input chiamato "name" che ci consente di recupare il valore dal controller --}}
                <form action="{{ route('admin.categories.update', $category) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{$category->name}}">
                        <div id="nameHelp" class="form-text">Inserisci il nome della categoria che vuoi creare</div>
                        @error('name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="color">Colore della categoria</label>
                        <input type="color" class="form-control form-control-color" id="color"  value="{{$category->color}}" title="Seleziona il colore della categoria" name="color">
                        @error('color')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Modifica la categoria</button>
                </form>

            </div>
        </div>
    </div>
@endsection