<div>
    <form method="GET" action="{{ route('search') }}">

        <div class="input-group mb-3 no-gutters mx-auto">
            <label class="sr-only" for="search">Αναζήτηση</label>
            <input type="text" max="255" class="form-control col-md-7 col-12 px-2" id="search" name="search">
            <button class="btn btn-medium-primary col-md-5 col-12">Αναζήτηση</button>
        </div>

        @csrf
    </form>
</div>
