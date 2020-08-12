<nav class="navbar navbar-expand-lg container">

    <a class="navbar-brand" href="{{ route('home') }}"><img src="/graphics/logo.png" width="200" title="Eordaia.info"></a>

    <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav my-auto ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('about') }}">Σχετικά</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact') }}">Επικοινωνία</a>
            </li>
        </ul>

        <div>
            {{--                <a href="{{ secure_url('/feed') }}" class="mx-1">--}}
            {{--                    <img src="/graphics/RSS.png" width="25" title="RSS News Feed">--}}
            {{--                </a>--}}
            <a href="https://twitter.com/eordaia_info" class="mx-1"><img src="/graphics/twitter-logo.png" width="25" title="Twitter Page"></a>

            <a href="https://www.facebook.com/eordaia.info" class="mx-1"><img src="/graphics/facebook-logo.png" width="25" title="Facebook Page"></a>
        </div>
    </div>

</nav>
