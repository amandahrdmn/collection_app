<?php

function getDB() {
    $db = new PDO('mysql:host=DB;dbname=collection_app', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

function getPlantData($db): array {
    $plant_query = $db->prepare("SELECT `science_name`,`name`,`plant_types`.`type` FROM `plants` 
                                    LEFT JOIN `plant_types` 
                                        ON `plants`.`type` = `plant_types`.`id`;");
    $plant_query->execute();
    $plant_data = $plant_query->fetchAll();

    return $plant_data;
}

function getPlantTypes($db): array {
    $plant_type_query = $db->prepare("SELECT `type` FROM `plant_types`;");
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
        $return_string = 'There is no data for this entry';
    } elseif (count($entry) < 3) {
        $return_string = 'There is not enough information given for this type of entry.';
    } elseif (!empty($entry)) {
        $return_string = "<div class='entry_box'>
                        <div class='entry science_name'>" . $entry['science_name'] . "</div>
                        <div class='entry'>" . ucwords($entry['name'],"/ -") . "</div>
                        <div class='entry'>" . ucwords(strtolower($entry['type']),"/ -") . "</div>
                    </div>";
    }

    return $return_string;
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

function checkforUniqueAddEntry($db, string $science_name, string $common_name): bool {
    $nonunique_entry_query = $db->prepare("SELECT `id` FROM `plants` WHERE `science_name` = ? OR `name` = ?;");
    $nonunique_entry_query->execute([$science_name, $common_name]);
    $nonunique_entry = $nonunique_entry_query->fetch();
    $nonunique_entry = !$nonunique_entry ? false : true;

    return $nonunique_entry;
}

function checkForWrongPlantType($db, string $type): int {
    $upper_type = strtoupper($type);
    $used_type_query = $db->prepare("SELECT `id` FROM `plant_types` WHERE `type` = ?;");
    $used_type_query->execute([$upper_type]);
    $used_type = $used_type_query->fetch();
    $type_int = (int) $used_type['id'];

    return $type_int;
}

function insertDataToDB($db, array $plantData): string {
    $add_entry_query = $db->prepare("INSERT INTO `plants` (`science_name`,`name`,`type`) VALUES (:science_name,:common_name,:type_int);");
    $add_entry_query->execute($plantData);

    return 'Entry Added';
}

function getErrorMessage(string $error): string {
    $error_string = ['1' => 'Please enter data for all fields.',
                    '2' => 'Oops! Something went wrong. Please try again.',
                    '3' => "The plant type given wasn't recognised. 
                            Please select from the list of possible types and try again.",
                    '4' => 'This entry has already been added.'];

    return $error_string[$error];
}