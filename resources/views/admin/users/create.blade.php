@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Εισαγωγή χρήστη</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="name">Όνομα</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">Όνομα</span>
                                </div>
                                <input type="text" max="255" class="form-control col-9 px-2" id="name" name="name"
                                       value="{{old('name')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="email">e-mail</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">e-mail</span>
                                </div>
                                <input type="email" max="255" class="form-control col-9 px-2" id="email" name="email"
                                       value="{{old('email')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="password">Password</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">Password</span>
                                </div>
                                <input type="password" max="255" class="form-control col-9 px-2" id="password" name="password"
                                       value="{{old('password')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="role_id" class="sr-only">Ρόλος</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">Ρόλος</span>
                                </div>
                                <select class="form-control col-9 px-2" id="role_id" name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">
                                            {{$role->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters my-2">
                                <label for="is_active" class="sr-only">Έγκριση</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100 bg-warning">Έγκριση</span>
                                </div>
                                <select class="form-control col-9 px-2" id="is_active" name="is_active">
                                    <option value="0">Ανενεργός</option>
                                    <option value="1" selected>Ενεργός</option>
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
