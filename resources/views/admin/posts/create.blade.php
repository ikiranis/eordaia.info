@extends('layouts.admin')

@section('content')

    @include('includes.apiToken')

    <x-error :errors="$errors" />

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
                                <label class="sr-only" for= l"title">Τίτλος</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Τίτλος</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="title" name="title"
                                       value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="body">Κείμενο</label>
                                <textarea class="form-control" id="body" name="body" rows="15">
                                    {{ old('body') }}
                                </textarea>
                            </div>

                            <div id="vueContainer">
                                <links :links="links"></links>

                                <tags :tags="tags"></tags>

                                <categories :categories="categories"></categories>

                                <videos :videos="videos"></videos>

                                <photos :photos="photos"></photos>
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
        let vue = new Vue({
            el: '#vueContainer',
            data: {
                tags: [],

				categories: {!!
                    json_encode($categories->map(function($item) {
                        return ['id' => $item->id, 'name' => $item->name];
                    }));
                !!},

                photos: [],

                links: [],

                videos: []
            }
        });
    </script>

@endsection

