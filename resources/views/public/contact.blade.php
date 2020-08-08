@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : Επικοινωνία
@endsection

@section('content')

    <div class="container">

        <div class="col-12 my-3">
            <div class="card">
                <div class="card-header">
                    <h1>Επικοινωνία</h1>
                </div>

                <div class="card-body article">
                    <p>Στείλτε μας οτιδήποτε μπορεί να ενδιαφέρει το <strong>eordaia.info</strong>, για δημοσίευση.</p>

                    <p>e-mail: <strong><a href="mailto:eordaia.info@gmail.com">eordaia.info@gmail.com</a></strong></p>

                    <p>Twitter account: <strong><a href="https://twitter.com/eordaia_info">twitter.com/eordaia_info</a></strong></p>

                    <p>Facebook page: <strong><a href="https://facebook.com/eordaiainfo-120099448002990">facebook.com/eordaiainfo-120099448002990</a></strong></p>
                </div>

            </div>

        </div>

    </div>


@endsection
