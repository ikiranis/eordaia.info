<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel sticky-top flex-md-nowrap p-0 px-3">
            <a class="navbar-brand" href="">
                Admin dashboard
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
<!--                    <ul>-->
<!--                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)-->
<!--                        <li>-->
<!--                            <a rel="alternate" hreflang="{{ $localeCode }}"-->
<!--                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">-->
<!--                                {{ $properties['native'] }}-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        @endforeach-->
<!--                    </ul>-->
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
<!--                    @guest-->
<!--                    <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>-->
<!--                    <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>-->
<!--                    @else-->
<!--                    <li class="nav-item dropdown">-->
<!--                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"-->
<!--                           aria-haspopup="true" aria-expanded="false">-->
<!--                            {{ Auth::user()->name }} <span class="mdi mdi-account-outline"></span>-->
<!--                        </a>-->
<!--                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
<!--                            <a class="dropdown-item" href="{{ route('logout') }}"-->
<!--                               onclick="event.preventDefault();-->
<!--                                                         document.getElementById('logout-form').submit();">-->
<!--                                Logout-->
<!--                            </a>-->

<!--                            <form id="logout-form" action="{{ route('logout') }}" method="POST"-->
<!--                                  style="display: none;">-->
<!--                                @csrf-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    @endguest-->
                </ul>
            </div>
        </nav>


        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar py-5">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <router-link :to="{ name: 'home' }" class="nav-link active"><span class="mdi mdi-home"></span>Home</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'home' }">Home</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'home' }">Home</router-link>
                            </li>

                        </ul>

                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    <div class="container">
                        <router-view></router-view>
                    </div>
                </main>
            </div>
        </div>



    </div>
</template>
<script>
    export default {}
</script>
