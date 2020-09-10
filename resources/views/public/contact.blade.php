@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : Επικοινωνία
@endsection

@section('content')

    <div class="container">
        <article>

            <div class="post-content px-3">

                <p>Στείλτε μας ανακοινώσεις, δελτία τύπου κτλ για δημοσίευση, στο email</p>

                <p>e-mail: <strong><a href="mailto:eordaia.info@gmail.com">eordaia.info@gmail.com</a></strong></p>

                <p>Twitter account: <strong><a href="https://twitter.com/eordaia_info">twitter.com/eordaia_info</a></strong></p>

                <p>Facebook page: <strong><a href="https://fb.me/eordaia.info">fb.me/eordaia.info</a></strong></p>

            </div>

        </article>
    </div>

@endsection
