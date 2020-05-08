@extends('layouts.admin')

@section('content')
    <h1>Σύνδεσμοι</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('links.create')}}">
            <button class="btn btn-info w-100">Εισαγωγή Συνδέσμου</button>
        </a>
    </div>

    @if(count($links)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">url</th>
                <th scope="col">Όνομα</th>
            </tr>
            </thead>
            <tbody>

            @foreach($links as $link)
                <tr>
                    <td><a href="{{route('links.edit', $link->id)}}">{{$link->id}}</a></td>
                    <td>{{$link->url}}</td>
                    <td>{{$link->name}}</td>
                    <td>
                        <form method="POST" action="{{route('links.destroy', $link->id)}}">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf

                            <button type="submit" class="btn btn-danger">Διαγραφή</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $links->links() }}
            </div>
        </div>

    @else
        <h1>Δεν υπάρχουν σύνδεσμοι</h1>
    @endif
@endsection
