<?php

session_start();

require('functions.php');

$plant_data = getDB ();

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
        <div class='entry_container'>
                <?php
                    makeAllTiles($plant_data);
                ?>
        </div>
    </div>
