@extends('layouts.admin')

@section('content')

    <x-error :errors="$errors" />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Εισαγωγή Φωτογραφίας</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('photos.adminStore') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="form-group my-3 col-lg-6 col-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"
                                               name="uploadFile" id="uploadFile"
                                               accept='image/*'>
                                        <label class="custom-file-label"
                                               for="uploadFile">Φωτογραφία</label>
                                    </div>
                                </div>

                                <div class="input-group my-3 col-lg-6 col-12">
                                    <label class="sr-only"
                                           for="photoReference">url</label>
                                    <div>
                                        <span class="input-group-text">url</span>
                                    </div>
                                    <input type="text" max="800" class="form-control" id="photoReference"
                                           name="photoReference" value="{{ old('url') }}">
                                </div>
                            </div>

                            <div class="row">
                                <label class="sr-only"
                                       for="photoDescription">Περιγραφή</label>
                                <textarea id="photoDescription" name="description" class="my-2 col-lg-8 col-12 mx-auto"
                                          placeholder="Περιγραφή" >{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
                                    Εισαγωγή
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
