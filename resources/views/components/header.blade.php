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

        <div class="social-icon">
            <a href="{{ secure_url('/feed') }}" ><span class="mdi mdi-rss-box" title="RSS feed"/></a>
            <a href="https://twitter.com/eordaia_info" ><span class="mdi mdi-twitter" title="Twitter page"/></a>

            <a href="https://www.facebook.com/eordaia.info" ><span class="mdi mdi-facebook" title="Facebook page"/></a>
        </div>
    </div>

</nav>
