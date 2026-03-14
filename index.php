<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];


// filter parking
$parking_requested = false;
if (isset($_GET['parking']) &&  $_GET['parking'] == 'on') {
    $parking_requested = true;
}

// filter vote
$minimum_vote = 0;
if(isset($_GET['minimum_vote']) && is_numeric($_GET['minimum_vote']) && $_GET['minimum_vote'] >= 0 && $_GET['minimum_vote'] <= 5){
    $minimum_vote = (int)$_GET['minimum_vote'];
};


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>php-hotel</title>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Hotels</h1>
        <h2 class="mb-3">Filtri</h2>
        <form action="">
            <div class="d-flex gap-2 my-2">
                <div class="form-control">
                <input type="checkbox" id="parking" name="parking">
                <label for="">C'è parcheggio?</label>
            </div>
            <div class="form-control">
                <input type="number" min="1" max="5" name="minimum_vote" id="minimum_vote">
                <label for="minimum_vote">Voto minimo</label>
            </div>
            </div>
            
            <button class="btn btn-primary">Filtra</button>
        </form>
        <hr>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($hotels as $hotel) {

                    // controllo filtro parcheggio
                    if ($parking_requested) {
                        if (!$hotel['parking']) {
                            continue;
                        }
                    }

                    // controllo voto minimo richiesto
                    if($hotel['vote'] < $minimum_vote){
                        continue;
                    }

                ?>
                    <tr>
                        <td><?php echo $hotel['name'] ?></td>
                        <td><?php echo $hotel['description'] ?></td>
                        <td><?php
                            echo $hotel['parking'] ? 'true' : 'false';
                            ?></td>
                        <td><?php echo $hotel['vote'] ?></td>
                        <td><?php echo $hotel['distance_to_cent'] ?></td>
                    </tr>

                <?php
                }
                ?>

            </tbody>
        </table>
    </div>

</body>

</html>