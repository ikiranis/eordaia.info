@extends('layouts.admin')

@section('content')
    <x-error :errors="$errors" />

    <h1>Φωτογραφίες</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('photos.create')}}">
            <button class="btn btn-info w-100">Εισαγωγή Φωτογραφίας</button>
        </a>
    </div>

    @if(count($photos)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Filename</th>
            </tr>
            </thead>
            <tbody>

            @foreach($photos as $photo)
                <tr>
                    <td><a href="{{route('photos.edit', $photo->id)}}">{{$photo->id}}</a></td>
                    <td>{{$photo->filename}}</td>
                    <td>
                        <form method="POST" action="{{route('photos.destroy', $photo->id)}}">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf

                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Είσαι σίγουρος για την διαγραφή;')">
                                Διαγραφή
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $photos->links() }}
            </div>
        </div>

    @else
        <h1>Δεν υπάρχουν φωτογραφίες</h1>
    @endif
@endsection
