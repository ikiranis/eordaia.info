@extends('layouts.admin')

@section('content')
    <h1>Δημοσιεύσεις</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('posts.create')}}">
            <button class="btn btn-info w-100">Εισαγωγή δημοσίευσης</button>
        </a>
    </div>

    @if(count($posts)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Τίτλος</th>
                <th scope="col">Χρήστης</th>
                <th scope="col">Ημ/νία</th>
                <th scope="col">Έγκριση</th>
                <th scope="col">Ενέργεια</th>
            </tr>
            </thead>
            <tbody>

            @foreach($posts as $post)
                <tr>
                    <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->created_at->diffForHumans() ?? ''}}</td>
                    <td>{{$post->approved==1 ? 'Ενεργό' : 'Ανενεργό'}}</td>

                    <td>
                        <form method="POST" action="{{route('posts.destroy', $post->id)}}">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf

                            <button type="submit" class="btn btn-danger">
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
                {{ $posts->links() }}
            </div>
        </div>


    @else
        <h1>Δεν υπάρχουν δημοσιεύσεις</h1>
    @endif
@endsection
