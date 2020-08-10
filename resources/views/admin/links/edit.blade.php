@extends('layouts.admin')

@section('content')

    <x-error :errors="$errors" />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Ενημέρωση Συνδέσμου</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('links.update', $link->id) }}" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="url">url</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">url</span>
                                </div>
                                <input type="text" max="800" class="form-control col-9 px-2" id="url" name="url"
                                       value="{{$link->url}}">
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
