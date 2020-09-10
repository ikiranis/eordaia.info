@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : Επικοινωνία
@endsection

@section('content')

    <div class="container">
        <article>

            <div class="post-content px-3">

                <div class="row mb-5">
                    <img src="/graphics/mail.svg" alt="Επικοινωνία" class="col-lg-4 col-12 mx-auto">
                </div>

                <div class="row">
                    <p class="mx-auto">Στείλτε μας ανακοινώσεις, δελτία τύπου κτλ για δημοσίευση, στο email</p>
                </div>

                <table>
                    <tr>
                        <td><span class="social-icon mdi mdi-email-outline" title="Email address"/></td>
                        <td><strong>&nbsp;<a href="mailto:eordaia.info@gmail.com">eordaia.info@gmail.com</a></strong></td>
                    </tr>

                    <tr>
                        <td>
                            <span class="social-icon mdi mdi-twitter" title="Twitter page"/>
                        </td>
                        <td>
                            <strong>&nbsp;<a href="https://twitter.com/eordaia_info">twitter.com/eordaia_info</a></strong>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <span class="social-icon mdi mdi-facebook" title="Facebook page"/>
                        </td>
                        <td>
                            <strong>&nbsp;<a href="https://fb.me/eordaia.info">fb.me/eordaia.info</a></strong>
                        </td>
                    </tr>

                </table>


            </div>

        </article>
    </div>

@endsection
