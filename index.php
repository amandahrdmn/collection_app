<?php
require_once('functions.php');

$plant_data = getDB();

echo DBCheck($plant_data);



?>
<!doctype html>
<html lang='en' font-family = 'Segoe UI, Helvetica, Verdana'>
<head>
    <title>collection_app_ahardman</title>
    <link href='normalize.css' rel='stylesheet' type='text/css'>
    <link href='collection_app_ahardman_stylesheet.css' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width">
</head>

<section class='entries'>
    <div class='container'>
        <h2>Plant Collection:</h2>
        <div class='entry_container')>
                <?php
                    foreach ($plant_data as $entry) {
                        echo makePlantEntryTile($entry);
                    }
                ?>
        </div>
        <form action="addpage.php" method="POST">
            <button type="submit">Add Entry</button>
        </form>
    </div>
</section>

