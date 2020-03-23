<?php
session_start();
$db = new PDO('mysql:host=DB;dbname=collection_app', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$plant_query = $db->prepare("SELECT `science_name`,`name`,`plant_types`.`type` FROM `plants` LEFT JOIN `plant_types` ON `plants`.`type` = `plant_types`.`id`;");
$plant_query->execute();
$plant_data=$plant_query->fetchAll();
?>
<!doctype html>
<html lang='en'>
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
                foreach ($plant_data as $entry) {
                    echo "<div class='entry_box'>
                                <div class='entry science_name'>" . $entry['science_name'] . "</div><div class='entry'>" . $entry['name'] . "</div><div class='entry'>" . $entry['type'] . "</div></div>";
                }
                ?>
        </div>
    </div>
