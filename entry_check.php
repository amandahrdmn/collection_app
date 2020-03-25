<?php
require_once('functions.php');
session_start();

$db = getDB();
$science_name = $_POST['science_name'];
$name = $_POST['name'];
$type = $_POST['type'];

if (empty($science_name) || empty($name) || empty($type)) {
    header('Location: addpage.php?entry_add_error=1');
} else {
    $nonunique_entry = checkforUniqueAddEntry($db, $science_name, $name);
    $used_type = checkForWrongPlantType($db, $type);

    if($nonunique_entry === false && $used_type !== ['not found']) {
        $dbInsertCheck = insertDataToDB($db, $science_name, $name, $used_type);
        if ($dbInsertCheck) {
            header('Location: index.php?entry_add_successful=1');
        } else {
            header('Location: index.php?entry_add_error=2');
        }
    } elseif ($used_type === ['not found']) {
        header('Location: addpage.php?entry_add_error=3');
    } elseif ($nonunique_entry === true) {
        header('Location: addpage.php?entry_add_error=4');
    }
}



