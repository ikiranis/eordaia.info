@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : About
@endsection

@section('content')

    <div class="container">

        <div class="col-12 my-3">
            <div class="card">
                <div class="card-header">
                    <h1>About</h1>
                </div>

                <div class="card-body article">
                    <p>Το <strong>eordaia.info</strong> είναι ένα site με πληροφορίες για την Πτολεμαϊδα και την ευρύτερη
                    περιοχή. Στην πλήρη ανάπτυξη του Θα περιλαμβάνει ειδησεογραφία, οδηγό αγοράς, αγγελίες κτλ.</p>

                    <p>Για αρχή λειτουργεί μόνο το ειδησεογραφικό κομμάτι, που περιλαμβάνει κυρίως θέματα της
                    επικαιρότητας. Στο eordaia.info θα γίνεται κυρίως μια προσπάθεια να οργανωθεί καλύτερα η ειδησεογραφία από
                    τα τοπικά sites. Θα είναι δηλαδή ένας συναθροιστής (aggregator) ειδήσεων.</p>

                    <p>Τα υπόλοιπα χαρακτηριστικά του site, θα αναπτυχθούν μέσα στο επόμενο διάστημα.</p>

                    <p>Το project είναι μια δημιουργία της <strong><a href="http://apps4net.eu">apps4net</a></strong></p>
                </div>

            </div>

        </div>

    </div>


@endsection