<div>
    <form method="GET" action="{{ route('search') }}">

        <div class="input-group mb-3 no-gutters mx-auto">
            <label class="sr-only" for="search">Αναζήτηση</label>
            <input type="text" max="255" class="form-control col-8 px-2" id="search" name="search">
            <button class="btn btn-medium-primary col-4">Αναζήτηση</button>
        </div>

        @csrf
    </form>
</div>
