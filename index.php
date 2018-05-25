<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/css/style.css"/>

    <title>Tarifs</title>
</head>
<body>

<div class="row">

    <?php

    $json = file_get_contents('http://sknt.ru/job/frontend/data.json');
    $tarifs = json_decode($json, true)['tarifs'];

    foreach ($tarifs as $tarif) {

        $title = $tarif['title'];
        $speed = $tarif['speed'];

        $pakets = $tarif['tarifs'];

        $prices = array();

        foreach ($pakets as $paket) {
            $prices[] = $paket['price'] / $paket['pay_period'];
        }
        $prices = min($prices).'-'.max($prices);

    ?>

    <div class='col-xs-12 col-sm-12 col-md-6 col-lg-4'>

        <p><?php echo $title; ?></p>

        <hr>

        <div class='row'>
            <div class='col-xs-10 col-sm-10 col-md-10 col-lg-10'>
                <p class='speed'><?php echo $speed; ?></p>
                <p><?php echo $prices; ?></p>
            </div>
            <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2'>
                <a href='#' class="next"></a>
            </div>
        </div>
        <hr>
        <a></a>
        <div id="page-bottom">
        </div>
    </div>

    <?php
    }
    ?>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>-->

</body>
</html>