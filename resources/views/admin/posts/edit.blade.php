@extends('layouts.admin')

@section('content')

    @include('includes.apiToken')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Ενημέρωση δημοσίευσης</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.update', $post->id) }}"
                              enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="title">Τίτλος</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Τίτλος</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="title" name="title"
                                       value="{{$post->title}}">
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="body">Κείμενο</label>
                                <div id="toolbar-container"></div>
                                <textarea class="form-control ckeditor" id="body" name="body">{{ $post->body }}</textarea>
                            </div>

                            <div id="tagsContainer">
                                <div class="input-group mb-3 no-gutters">
                                    <label class="sr-only" for="tag">Tag</label>
                                    <div class="input-group-prepend col-2">
                                        <span class="input-group-text w-100">Tag</span>
                                    </div>
                                    <input type="text" max="255" v-model="tag" class="form-control col-8 px-2"
                                           id="tag" name="tag">

                                    <span class="btn btn-success col-2" @click="insertTag">Προσθήκη</span>

                                    <input type="hidden" v-for="tag in tags" name="tags[]" :value="tag.id">

                                </div>

                                <div class="my-2 row">
                                    <span class="my-1 mx-2 px-2 bg-primary text-light" v-for="tag in tags">{% tag.name %}</span>
                                </div>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="reference">Πηγή</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Πηγή</span>
                                </div>
                                <input type="text" max="800" class="form-control col-10 px-2" id="reference"
                                       name="reference" value="{{$post->reference}}">
                            </div>

                            <div class="row border p-2">

                                <div class="col-lg-5">
                                    <img src="{{$post->photo ? $post->photo->fullPathName : 'http://via.placeholder.com/350x350'}}"
                                         class="img-fluid">
                                </div>

                                <div class="col-lg-7 col-12 my-auto">

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="uploadFile"
                                                   id="uploadFile"
                                                   accept='image/*'>
                                            <label class="custom-file-label"
                                                   for="customFile">Φωτογραφία</label>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <label class="sr-only"
                                               for="photo_reference">Πηγή</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Πηγή</span>
                                        </div>
                                        <input type="text" max="800" class="form-control"
                                               id="photo_reference" name="photo_reference"
                                               value="{{$post->photo ? $post->photo->reference : ''}}">
                                    </div>

                                </div>

                            </div>

                            <div class="input-group mb-3 no-gutters my-2">
                                <label for="approved" class="sr-only">Έγκριση</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100 bg-warning">Έγκριση</span>
                                </div>
                                <select class="form-control col-10 px-2" id="approved" name="approved">
                                    <option value="0" {{$post->approved==0 ? 'selected' : ''}}>Ανενεργό</option>
                                    <option value="1" {{$post->approved==1 ? 'selected' : ''}}>Ενεργό</option>
                                </select>
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

@section('scripts')

    <script>
		let tags = new Vue({
			el: '#tagsContainer',
			delimiters: ['{%', '%}'],
			data: {
				tags: {!!
                    json_encode($post->tags()->get()->map(function($item) {
                        return ['id' => $item->id, 'name' => $item->name];
                    }))
                !!},
				tag: ''
			},
			methods: {
				insertTag(e) {
					let myData = {
						name: this.tag
					}

					axios.post('/api/tag', myData)
						.then(response => {
							this.tags.push({id: response.data.id, name: response.data.name})
							this.tag = ''
						})
						.catch(e => console.log(e))
				}
			}
		});
    </script>

@endsection
