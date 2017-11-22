<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ISS - Błąd</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link href="Assets/css/app.css" rel="stylesheet">
</head>
<body>

<!-- Background -->
<section class="bg"></section>

<!-- Content -->
<section class="content">
    <div class="container">
        <div class="jumbotron">
            <h2>Uwaga! Wystąpił nieoczekiwany błąd</h2>
            <table class="table table-sm">
                <tbody>
                <?php foreach($messages as $observer => $message) { ?>
                    <tr>
                        <th scope="row"><?= $observer ?></th>
                        <td><?= $message ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Bootstrap 4 JS -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>