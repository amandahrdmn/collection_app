<?php

function getDB() {
    $db = new PDO('mysql:host=DB;dbname=collection_app', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $plant_query = $db->prepare("SELECT * FROM `plants` 
                                    LEFT JOIN `plant_types` 
                                        ON `plants`.`type` = `plant_types`.`id`;");
    $plant_query->execute();

    $plant_data = $plant_query->fetchAll();

    return $plant_data;
}

function DBCheck($data): string {
    if (empty($data)) {
        return 'There is no data for this collection.';
    } else {
        if (gettype($data) !== 'array') {
            return 'Database error. Please refresh page.';
        } else {
            return ' ';
        }
    }
}

function makePlantEntryTile(array $entry): string {
    if (empty($entry)) {
        return 'There is no data for this entry';
    } elseif (count($entry) < 4) {
        return 'There is not enough data for this entry';
    } elseif (!empty($entry)) {
        return "<div class='entry_box'>
                        <div class='entry science_name'>" . $entry['science_name'] . "</div>
                        <div class='entry'>" . $entry['name'] . "</div>
                        <div class='entry'>" . $entry['type'] . "</div>
                    </div>";
    }
}
