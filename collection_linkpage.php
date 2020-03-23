<?php
    $db = new PDO('mysql:host=DB;dbname=collection_app', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $plant_query = $db->prepare("SELECT `science_name`,`name`,`plant_types`.`type` FROM `plants` LEFT JOIN `plant_types` ON `plants`.`type` = `plant_types`.`id`;");
    $plant_query->execute();
    $plant_data=$plant_query->fetchAll();
    foreach ($plant_data as $entry) {
        echo $entry['science_name'] . ";\t" . $entry['name'] . ";\t" .  $entry['type'] . "<br>";
    }
?>

