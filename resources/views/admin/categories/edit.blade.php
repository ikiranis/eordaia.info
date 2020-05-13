@extends('layouts.admin')

@section('content')

    <x-error :errors="$errors" />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Ενημέρωση Κατηγορίας</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="name">Όνομα</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">Όνομα</span>
                                </div>
                                <input type="text" max="15" class="form-control col-9 px-2" id="name" name="name"
                                       value="{{$category->name}}">
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
                                    Ενημέρωση
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
