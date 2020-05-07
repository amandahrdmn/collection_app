<?php
require_once('functions.php');
session_start();
$db = getDB();

if (empty($_POST['science_name']) || empty($_POST['common_name']) || empty($_POST['plant_type'] || empty($_POST['image']))) {
    header('Location: addpage.php?entry_add_error=1');
} else {
    $nonunique_entry = checkforUniqueAddEntry($db, $_POST['science_name'], $_POST['common_name']);

    $plantData = $_POST;

    if ($nonunique_entry['id'] === [0]) {
        $dbInsertCheck = insertDataToDB($db, $plantData);
        if ($dbInsertCheck) {
            header('Location: index.php?entry_add_successful=1');
        } else {
            header('Location: index.php?entry_add_error=2');
        }
    } elseif ($nonunique_entry['id'] !== [0]) {
        header('Location: addpage.php?entry_add_error=3');
    }
}