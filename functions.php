<?php

function getDB() {
    $db = new PDO('mysql:host=DB;dbname=collection_app', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

function getPlantData($db): array {
    $plant_query = $db->prepare("SELECT `plants`.`id`,`science_name`,`name`,`plant_types`.`type`,`image` FROM `plants` 
                                    LEFT JOIN `plant_types` 
                                        ON `plants`.`type` = `plant_types`.`id`;");
    $plant_query->execute();
    $plant_data = $plant_query->fetchAll();

    return $plant_data;
}

function getPlantDataForEntry($db, string $entry_number): array {
    $plant_query = $db->prepare("SELECT `plants`.`id`,`science_name`,`name`,`plant_types`.`type`,`image` FROM `plants`
                                    LEFT JOIN `plant_types` 
                                        ON `plants`.`type` = `plant_types`.`id`
                                    WHERE `plants`.`id` = ?;");
    $plant_query->execute([$entry_number]);
    $plant_data = $plant_query->fetch();

    return $plant_data;
}

function getPlantTypes($db): array {
    $plant_type_query = $db->prepare("SELECT `id`,`type` FROM `plant_types`;");
    $plant_type_query->execute();
    $plant_types = $plant_type_query->fetchAll();

    return $plant_types;
}

function getPlantScienceName($db, string $id): array {
    $plant_science_name_query = $db->prepare("SELECT `plants`.`science_name` FROM `plants` WHERE `plants`.`id` = ?;");
    $plant_science_name_query->execute([$id]);
    $plant_science_name = $plant_science_name_query->fetchAll();

    return $plant_science_name[0];
}

function getPlantCommonName($db, string $id): array {
    $plant_common_name_query = $db->prepare("SELECT `plants`.`name` FROM `plants` WHERE `plants`.`id` = ?;");
    $plant_common_name_query->execute([$id]);
    $plant_common_name = $plant_common_name_query->fetchAll();

    return $plant_common_name[0];
}

function getPlantImage($db, string $id): array {
    $plant_image_query = $db->prepare("SELECT `plants`.`image` FROM `plants` WHERE `plants`.`id` = ?;");
    $plant_image_query->execute([$id]);
    $plant_image = $plant_image_query->fetchAll();

    return $plant_image[0];
}

function getPlantType($db, string $id): array {
    $plant_type_query = $db->prepare("SELECT `plants`.`type` FROM `plants` WHERE `plants`.`id` = ?;");
    $plant_type_query->execute([$id]);
    $plant_type = $plant_type_query->fetchAll();

    return $plant_type[0];
}

function checkforUniqueAddEntry($db, string $science_name, string $common_name): array {
    $nonunique_entry_query = $db->prepare("SELECT `id` FROM `plants` WHERE `science_name` = ? OR `name` = ?;");
    $nonunique_entry_query->execute([$science_name, $common_name]);
    $nonunique_entry = $nonunique_entry_query->fetch();
    $nonunique_entry = !empty($nonunique_entry) ? $nonunique_entry : ['id' => 0];

    return $nonunique_entry;
}

function checkforUniqueEditEntry($db, array $plant_data): bool {
    $nonunique_entry_query = $db->prepare("SELECT `id` FROM `plants` 
                                            WHERE `science_name` = :science_name 
                                                AND `name` = :common_name
                                                AND `type` = :plant_type
                                                AND `image` = :image
                                                AND `id = :id;");
    $nonunique_entry_query->execute($plant_data);
    $nonunique_entry = $nonunique_entry_query->fetch();
    $nonunique_entry = !$nonunique_entry ? false : true;

    return $nonunique_entry;
}

function insertDataToDB($db, array $plantData): bool {
    $add_entry_query = $db->prepare("INSERT INTO `plants` (`science_name`,`name`,`type`,`image`) VALUES (:science_name,:common_name,:plant_type,:image);");
    $entry_check = $add_entry_query->execute($plantData);

    return $entry_check;
}

function editDBData($db, array $plantData): bool {
    $add_entry_query = $db->prepare("UPDATE `plants` 
                                        SET `science_name` = :science_name,
                                            `name` = :common_name,
                                            `type` = :plant_type,
                                            `image` = :image
                                        WHERE `id` = :id;");
    $entry_check = $add_entry_query->execute($plantData);
    return $entry_check;
}

function deleteEntry($db, string $id): bool {
    $add_entry_query = $db->prepare("DELETE FROM `plants` 
                                        WHERE `id` = ?;");
    $entry_check = $add_entry_query->execute([$id]);
    return $entry_check;
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
    } elseif (count($entry) < 5) {
        $return_string = 'There is not enough information given for this type of entry.';
    } elseif (!empty($entry)) {
        $return_string = "<div class='entry_box'>
                        <img src='" . $entry['image'] . "'>
                        <div class='entry science_name'>" . $entry['science_name'] . "</div>
                        <div class='entry'>" . ucwords($entry['name'],"/ -") . "</div>
                        <div class='entry'>" . ucwords(strtolower($entry['type']),"/ -") . "</div>
                        <form action='editpage.php' method='POST'>
                            <button class='edit_button' 
                                    type='submit' 
                                    name='entry_number' 
                                    value='" . $entry['id'] . "'>Edit</button>
                            <button class='delete_button' 
                                    type='submit' 
                                    name='entry_number' 
                                    formaction='deletepage.php'
                                    value='" . $entry['id'] . "'>Delete</button>
                        </form>
                    </div>";
    }

    return $return_string;
}

function getPlantTypeOptions(array $plant_types): string {
    $return_string = '<option disable selected value class = \'styled_option\'></option>';
    foreach ($plant_types as $type_option) {
        $return_string .= '<option class = \'styled_option\' value="' . $type_option['id'] . '">'
            . ucwords(strtolower($type_option['type']), '/ -')
            . '</option>';
    }

    return $return_string;
}

function removeTileButtons(string $tile_string): string {
    $start_slice = strpos($tile_string, '<form');
    $end_slice = strpos($tile_string, '/form>');
    $beginning_string = substr($tile_string, 0, $start_slice);
    $end_string = '</div>';

    return $beginning_string . $end_string;
}

function getErrorMessage(string $error): string {
    $error_string = ['1' => 'Please enter data for all fields.',
        '2' => 'Oops! Something went wrong. Please try again.',
        '3' => 'This entry has already been added.'];

    if (array_key_exists($error, $error_string)) {
        return $error_string[$error];
    } else {
        return 'Undefined error. Please try again.';
    }
}

function getErrorMessageEdit(string $error): string {
    $error_string = ['1' => "You haven't changed any data. Please try again.",
                    '2' => 'This entry has previously been added to the collection.
                            Please enter different details.',
                    '3' => 'Oops! Something went wrong. Please try again.'];

    if (array_key_exists($error, $error_string)) {
        return $error_string[$error];
    } else {
        return 'Undefined error. Please try again.';
    }
}