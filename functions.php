<?php

function getDB () {
    $db = new PDO('mysql:host=DB;dbname=collection_app', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $plant_query = $db->prepare("SELECT * FROM `plants` LEFT JOIN `plant_types` ON `plants`.`type` = `plant_types`.`id`;");
    $plant_query->execute();

   $plant_data = $plant_query->fetchAll();
   if (!empty($plant_data)) {
       if (gettype($plant_data) === 'array') {
           return $plant_data;
       } else {
            echo 'Unexpected error. Please refresh page.';
       }
   } else {
       echo 'There is no data for this collection.';
   }
}

function makeAllTiles ($data) {
    foreach ($data as $entry) {
        makePlantEntryTile($entry);
    }
}

function makePlantEntryTile (array $entry) {
    if (empty($entry)) {
        echo 'There is no data for this entry';
    } elseif (count($entry) < 4) {
        echo 'There is not enough data for this entry';
    } elseif (!empty($entry)) {
        echo "<div class='entry_box'><div class='entry science_name'>" . $entry['science_name'] . "</div><div class='entry'>" . $entry['name'] . "</div><div class='entry'>" . $entry['type'] . "</div></div>";
    }
}
