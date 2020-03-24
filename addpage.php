<!doctype html>
<html lang='en' font-family = 'Segoe UI, Helvetica, Verdana'>
<head>
    <title>collection_app_ahardman</title>
    <link href='normalize.css' rel='stylesheet' type='text/css'>
    <link href='collection_app_new_entry_stylesheet.css' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width">
</head>



<section class= 'container'>
    <h2>Add Entry</h2>
    <form id='add_entry' action="entry_check.php" method="POST" >
        <div>
            <input type="text" name="science_name" placeholder="Scientific Name">
        </div>
        <div>
            <input type="password" name="name" placeholder="Common Name">
        </div>
        <div>
            <input type="password" name="type" placeholder="Plant Type">
        </div>
        <div>
            <button type="submit">Add Entry</button>
        </div>
    </form>
</section>

<?php
?>


