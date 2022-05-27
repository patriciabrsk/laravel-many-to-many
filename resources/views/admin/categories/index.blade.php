@extends('layouts.app')

@section('content')
    <div class="container-fluid w-75 mx-auto" id="categories-wrapper">
        <div class="row">
            @if(session('deleted-message'))
                <div class="col-12">
                    <div class="alert alert-warning">
                        {{session('deleted-message')}}
                    </div>
                </div>
            @endif

            @if(session('message'))
                <div class="col-12">
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                </div>
            @endif

            <div class="col-12">
                <a href="{{route('admin.categories.create')}}" class="btn btn-primary text-white">Add new topic</a>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td style="background-color: {{ $category->color }}">
                                <a href="{{route("admin.categories.show", $category) }}" class="text-white">
                                    {{ $category->name }}
                                </a>
                            </td>

                            <td class="d-flex">
                                <a href="{{ route("admin.categories.edit", $category) }}" class="btn btn-success btn-sm me-2 text-white">Edit</a>


                                <form action="{{route('admin.categories.destroy', $category)}}" method="POST" class="category-form-destroyer" category-title="{{ $category->name }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"  class="btn btn-danger btn-sm text-white">Delete</a>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">There are no topics.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('footer-scripts')
    <script defer>
        const deleteForms = document.querySelectorAll('.category-form-destroyer');
        console.log(deleteForms);
        deleteForms.forEach(singleForm => {
            singleForm.addEventListener('submit', function (event) {
                event.preventDefault(); 
                userConfirmation = window.confirm(`Are you sure you want to delete ${this.getAttribute('category-title')}?` );
                if (userConfirmation) {
                    this.submit();
                }
            })
        });
    </script>
@endsection
