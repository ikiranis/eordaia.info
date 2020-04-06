@extends('layouts.admin')

@section('content')

    @include('includes.apiToken')

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
                                <label class="form-check-label" for="body">Κείμενο</label>
                                <textarea class="form-control" id="body" name="body" rows="15"></textarea>
                            </div>

                            <div id="tagsContainer">
                                <tags :tags="tags"  />

{{--                                <div class="input-group mb-3 no-gutters">--}}
{{--                                    <label class="sr-only" for="tag">Κατηγορία</label>--}}
{{--                                    <div class="input-group-prepend col-2">--}}
{{--                                        <span class="input-group-text w-100">Κατηγορία</span>--}}
{{--                                    </div>--}}
{{--                                    <input type="text" max="255" v-model="category" class="form-control col-8 px-2"--}}
{{--                                           id="category" name="category">--}}

{{--                                    <span class="btn btn-success col-2" @click="insertTag">Προσθήκη</span>--}}

{{--                                    <div v-for="category in categories">--}}
{{--                                        <input type="checkbox" name="categories" v-model="categories">--}}

{{--                                        <div class="input-group-text col">--}}
{{--                                            <label for="categories" class="my-1">{% category.name %}</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <input type="hidden" v-for="category in categories" name="categories[]" :value="category.id">--}}

{{--                                </div>--}}

{{--                                <div class="my-2 row">--}}
{{--                                    <span class="my-1 mx-2 px-2 bg-primary text-light" v-for="category in categories">{% category.name %}</span>--}}
{{--                                </div>--}}
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

@endsection

@section('scripts')

    <script>
        let tags = new Vue({
            el: '#tagsContainer',
            delimiters: ['{%', '%}'],
            data: {
                tags: [],
				{{--categories: {!!--}}
                {{--    json_encode($categories->map(function($item) {--}}
                {{--        return ['id' => $item->id, 'name' => $item->name];--}}
                {{--    }));--}}
                {{--!!},--}}
            }
        });
    </script>

@endsection

