@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Εισαγωγή δημοσίευσης</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="title">Τίτλος</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Τίτλος</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="title" name="title"
                                       value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="description">Περιγραφή</label>
                                <textarea class="form-control" id="description" name="description"
                                          rows="2">{{old('description')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="body">Κείμενο</label>
                                <textarea class="form-control" id="body" name="body" rows="15"></textarea>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="reference">Πηγή</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Πηγή</span>
                                </div>
                                <input type="text" max="800" class="form-control col-10 px-2" id="reference"
                                       name="reference"
                                       value="{{old('reference')}}">
                            </div>

                            <div class="row my-3 border">

                                <div class="form-group my-3 col-lg-6 col-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="uploadFile"
                                               id="uploadFile"
                                               accept='image/*'>
                                        <label class="custom-file-label"
                                               for="customFile">Φωτογραφία</label>
                                    </div>
                                </div>

                                <div class="input-group my-3 col-lg-6 col-12">
                                    <label class="sr-only"
                                           for="photo_reference">Πηγή</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Πηγή</span>
                                    </div>
                                    <input type="text" max="800" class="form-control" id="photo_reference"
                                           name="photo_reference"
                                           value="{{old('photo_reference')}}">
                                </div>

                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="author">Συγγραφέας</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Συγγραφέας</span>
                                </div>
                                <input type="text" max="25" class="form-control col-10 px-2" id="author"
                                       name="author"
                                       value="{{old('author')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters my-2">
                                <label for="approved" class="sr-only">Έγκριση</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100 bg-warning">Έγκριση</span>
                                </div>
                                <select class="form-control col-10 px-2" id="approved" name="approved">
                                    <option value="0">Ανενεργό</option>
                                    <option value="1" selected>Ενεργό</option>
                                </select>
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

    @include('includes.editor')

@endsection
