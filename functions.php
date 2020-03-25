<?php

function getDB() {
    $db = new PDO('mysql:host=DB;dbname=collection_app', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

function getPlantData($db): array {
    $plant_query = $db->prepare("SELECT * FROM `plants` 
                                    LEFT JOIN `plant_types` 
                                        ON `plants`.`type` = `plant_types`.`id`;");
    $plant_query->execute();

    $plant_data = $plant_query->fetchAll();

    return $plant_data;
}

function getPlantTypes($db): array {
    $plant_type_query = $db->prepare("SELECT `type` FROM `plant_types`");
    $plant_type_query->execute();

    $plant_types = $plant_type_query->fetchAll();
    return $plant_types;
}

function DBCheck(array $data): string {
    if (empty($data)) {
        return 'There is no data for this collection.';
    } else {
        if (gettype($data) !== 'array') {
            return 'Unexpected error. Please refresh page.';
        } else {
            return '';
        }
    }
}

function makePlantEntryTile(array $entry): string {
    if (empty($entry)) {
        return 'There is no data for this entry';
    } elseif (count($entry) < 4) {
        return 'There is not enough information given for this type of entry.';
    } elseif (!empty($entry)) {
        return "<div class='entry_box'>
                        <div class='entry science_name'>" . $entry['science_name'] . "</div>
                        <div class='entry'>" . ucwords($entry['name'],"/ -") . "</div>
                        <div class='entry'>" . ucwords(strtolower($entry['type']),"/ -") . "</div>
                    </div>";
    }
}

function listPlantTypes(array $plant_types): string {
    if (array_key_exists('type',$plant_types[0])) {
        $type_echo = '<ul>';
        foreach ($plant_types as $entry) {
            $type_echo.= '<li>' . ucwords(strtolower($entry['type']),"/ -") . '</li>';
        }
        $type_echo.= '</ul>';
    } else {
        $type_echo = 'Array key error. Please enter different data.';
    }
    return $type_echo;
}

function checkforUniqueAddEntry($db, string $science_name): bool {
    $nonunique_entry_query = $db->prepare("SELECT `id` FROM `plants` WHERE `science_name` = ?;");
    $nonunique_entry_query->execute([$science_name]);
    $nonunique_entry = $nonunique_entry_query->fetch();
    if ($nonunique_entry !== false) {
        $nonunique_entry = true;
    }

    return $nonunique_entry;
}

function checkForWrongPlantType($db, string $type): array {
    $used_type_query = $db->prepare("SELECT `id` FROM `plant_types` WHERE `type` = upper(?);");
    $used_type_query->execute([$type]);
    $used_type = $used_type_query->fetch();
    if ($used_type === false) {
        $used_type = ['not found'];
    }
    return $used_type;
}

function insertDataToDB($db, string $science_name, string $name, array $used_type): string {
    $add_entry_query = $db->prepare("INSERT INTO `plants` (`science_name`,`name`,`type`) VALUES (?,?,?);");
    $add_entry_query->execute([$science_name, $name, $used_type['id']]);
    return 'Entry Added';
}