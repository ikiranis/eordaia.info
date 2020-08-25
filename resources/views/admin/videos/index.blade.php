@extends('layouts.admin')

@section('content')
    <x-error :errors="$errors" />

    <h1>Video</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('videos.create')}}">
            <button class="btn btn-info w-100">Εισαγωγή Video</button>
        </a>
    </div>

    @if(count($videos)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Όνομα</th>
            </tr>
            </thead>
            <tbody>

            @foreach($videos as $video)
                <tr>
                    <td><a href="{{route('videos.edit', $video->id)}}">{{$video->id}}</a></td>
                    <td>{{$video->name}}</td>
                    <td>
                        <form method="POST" action="{{route('videos.destroy', $video->id)}}">
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
                {{ $videos->links() }}
            </div>
        </div>

    @else
        <h1>Δεν υπάρχουν video</h1>
    @endif
@endsection
