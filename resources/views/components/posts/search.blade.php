<div>
    <form method="GET" action="{{ route('search') }}">

        <div class="input-group mb-3 no-gutters mx-auto">
            <label class="sr-only" for="search">Αναζήτηση</label>
            <input type="text" max="255" class="form-control col-10 px-2" id="search" name="search">
            <span class="btn-medium-primary col-2 text-center social-icon"><span class="mdi mdi-magnify"/></span>
        </div>

        @csrf
    </form>
</div>
