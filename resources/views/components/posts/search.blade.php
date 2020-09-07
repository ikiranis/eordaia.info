<div>
    <form method="GET" name="searchForm" action="{{ route('search') }}">

        <div class="input-group mb-3 no-gutters mx-auto search-container">
            <label class="sr-only" for="search">Αναζήτηση</label>
            <input type="text" max="255" class="form-control col-10 px-2" id="search" name="search">
            <span type="submit" onclick="document.searchForm.submit();" class="btn-medium-primary col-2 text-center">
                <span class="mdi mdi-magnify search-icon"/>
            </span>
        </div>

        @csrf
    </form>
</div>
