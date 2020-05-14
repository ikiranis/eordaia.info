@extends('layouts.admin')

@section('content')

    <x-error :errors="$errors" />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Ενημέρωση Φωτογραφίας</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('photos.update', $photo->id) }}" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="row">
                                <div class="col-md-4 col-12 mx-auto">
                                    <img src="{{ $photo->photoUrl ? $photo->photoUrl : $photo->url }}"
                                         class="card-img btn">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group my-3 col-lg-6 col-12 mx-auto">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"
                                               name="file" id="file"
                                               accept='image/*'>
                                        <label class="custom-file-label"
                                               for="uploadFile">Φωτογραφία</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="sr-only"
                                       for="photoDescription">Περιγραφή</label>
                                <textarea id="photoDescription" name="description" class="my-2 col-lg-8 col-12 mx-auto"
                                          placeholder="Περιγραφή" >{{ $photo->description }}</textarea>
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
