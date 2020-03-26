<?php
require_once('functions.php');
session_start();

$db = getDB();

if (empty($_POST['science_name']) || empty($_POST['common_name']) || empty($_POST['type'])) {
    header('Location: addpage.php?entry_add_error=1');
} else {
    $nonunique_entry = checkforUniqueAddEntry($db, $_POST['science_name'], $_POST['common_name']);
    $type_int = checkForWrongPlantType($db, $_POST['type']);

    $plantData = $_POST;
    unset($plantData['type']);
    $plantData['type_int'] = $type_int;
    if (!$nonunique_entry && $type_int !== 0) {
        $dbInsertCheck = insertDataToDB($db, $plantData);
        if ($dbInsertCheck) {
            header('Location: index.php?entry_add_successful=1');
        } else {
            header('Location: index.php?entry_add_error=2');
        }
    } elseif ($type_int === 0) {
        header('Location: addpage.php?entry_add_error=3');
    } elseif ($nonunique_entry) {
        header('Location: addpage.php?entry_add_error=4');
    }
}



