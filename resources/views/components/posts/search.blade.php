<div>
    <form method="GET" action="{{ route('search') }}">

        <div class="input-group mb-3 no-gutters mx-auto search">
            <label class="sr-only" for="search">Αναζήτηση</label>
            <input type="text" max="255" class="form-control col-10 px-2" id="search" name="search">
            <button class="btn-medium-primary col-2 text-center search-icon"><span class="mdi mdi-magnify"/></button>
        </div>

        @csrf
    </form>
</div>
