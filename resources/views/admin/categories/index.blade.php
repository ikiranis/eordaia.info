@extends('layouts.admin')

@section('content')
    <x-error :errors="$errors" />

    <h1>Κατηγορίες</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('categories.create')}}">
            <button class="btn btn-info w-100">Εισαγωγή κατηγορίας</button>
        </a>
    </div>

    @if(count($categories)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Όνομα</th>
            </tr>
            </thead>
            <tbody>

            @foreach($categories as $category)
                <tr>
                    <td><a href="{{route('categories.edit', $category->id)}}">{{$category->id}}</a></td>
                    <td>{{$category->name}}</td>
                    <td>
                        <form method="POST" action="{{route('categories.destroy', $category->id)}}">
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
                {{ $categories->links() }}
            </div>
        </div>

    @else
        <h1>Δεν υπάρχουν κατηγορίες</h1>
    @endif
@endsection
