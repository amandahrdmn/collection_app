<?php

function getDB () {
    $db = new PDO('mysql:host=DB;dbname=collection_app', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $plant_query = $db->prepare("SELECT * FROM `plants` LEFT JOIN `plant_types` ON `plants`.`type` = `plant_types`.`id`;");
    $plant_query->execute();

    return $plant_query;
}

function makeAllTiles ($query) {
    $plantEntry = getDataEntry($query);
    while ($plantEntry) {
        makePlantEntryTile($plantEntry);
        $plantEntry = getDataEntry($query);
    }
}

function getDataEntry(object $dataInput) {
    if (!empty($dataInput)) {
        if (gettype($dataInput) === 'object') {
            $entry = $dataInput->fetch();
            return $entry;
        } else {
            echo 'Please input the correct data type';
        }
    } else {
        echo 'There is no data for this collection.';
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
