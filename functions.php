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
             return 'Unexpected error. Please refresh page.';
         }
    } else {
        return 'There is no data for this collection.';
    }
}

function DBCheck ($data) {
    if (gettype($data) !== 'array') {
        echo $data;
    }
}

function makePlantEntryTile (array $entry): string {
    if (empty($entry)) {
        return 'There is no data for this entry';
    } elseif (count($entry) < 4) {
        return 'There is not enough data for this entry';
    } elseif (!empty($entry)) {
        return "< class='entry_box'><img src=" . $entry['image']. " alt='entry_image'><div class='entry science_name'>" . $entry['science_name'] . "</div><div class='entry'>" . $entry['name'] . "</div><div class='entry'>" . $entry['type'] . "</div></div>";
    }
}
