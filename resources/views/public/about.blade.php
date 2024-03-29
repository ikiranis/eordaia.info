@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : Σχετικά
@endsection

@section('content')

    <div class="container">
        <article>

            <div class="post-content px-3">

                <div class="row mb-5">
                    <img src="/graphics/about.svg" alt="Σχετικά" class="col-lg-4 col-12 mx-auto">
                </div>

                <p>Το <strong>eordaia.info</strong> είναι ένα site με πληροφορίες για την <strong>Πτολεμαϊδα</strong> και την ευρύτερη
                    περιοχή. Στην πλήρη ανάπτυξη του Θα περιλαμβάνει ειδησεογραφία, οδηγό αγοράς, αγγελίες κτλ.</p>

                <p>Για αρχή λειτουργεί μόνο το ειδησεογραφικό κομμάτι, που περιλαμβάνει κυρίως θέματα της
                    επικαιρότητας. Στο <strong>eordaia.info</strong> θα γίνεται κυρίως μια προσπάθεια να οργανωθεί καλύτερα η
                    ειδησεογραφία από τα τοπικά sites. Θα είναι δηλαδή ένας συναθροιστής (aggregator) ειδήσεων.</p>

                <p>Τα υπόλοιπα χαρακτηριστικά του site, θα αναπτυχθούν μέσα στο επόμενο διάστημα.</p>

                <p>Το project είναι μια δημιουργία της <strong><a href="http://apps4net.eu">apps4net</a></strong></p>

            </div>

        </article>
    </div>


@endsection
