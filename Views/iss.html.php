<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <base href="<?= $baseUrl ?>">
    <title>ISS - Znajdź stację</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link href="Assets/css/app.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="">ISS</a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="">Znajdź stację<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact">Kontakt</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Background -->
<section class="bg"></section>

<!-- Content -->
<section class="content">
    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <h2 class="col-md-8">Obecna pozycja stacji ISS <small><span class="badge badge-primary"><?= $now ?></span></small></h2>
                <div class="col-md-4 text-right">
                    <a class="btn btn-primary refresh" href="" role="button">Odśwież stronę <span class="glyphicon glyphicon-refresh"></span></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <table class="table table-sm">
                <tbody>
                <tr>
                    <th scope="row">Adres (Google Geocoding API)</th>
                    <td><?= $address ?></td>
                </tr>
                <tr>
                    <th scope="row">Strefa czasowa</th>
                    <td><?= $timeZone ?></td>
                </tr>
                <tr>
                    <th scope="row">Współrzędne geograficzne</th>
                    <td><?= $geolocationString ?></td>
                </tr>
                </tbody>
            </table>
            <div id="map"></div>
        </div>
    </div>
</section>

<!-- Bootstrap 4 JS -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- App JS -->
<script src="Assets/js/events.js"></script>
<script src="Assets/js/gmap.js"></script>
<script>
    var googleMap = new Gmap(<?= $geolocationString ?>);
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQDt3Aj56WexDCvlOoCxHuCM1qT7L4-yM&callback=googleMap.initMap" async defer></script>

</body>
</html>