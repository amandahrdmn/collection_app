<?php
require_once('functions.php');
session_start();

$db = getDB();

if ($_POST['science_name'] === '' && $_POST['common_name'] === '' && $_POST['image']  === '' && $_POST['plant_type']  === '') {
    header('Location: editpage.php?entry_edit_error=1');
} else {
    $plant_data = $_POST;
    $plant_data['id'] = $_SESSION['id'];

    if ($_POST['science_name'] === '') {
        $plant_data['science_name'] = getPlantScienceName($db,$_SESSION['id'])['science_name'];
    }
    if ($_POST['common_name'] === '') {
        $plant_data['common_name'] = getPlantCommonName($db,$_SESSION['id'])['name'];
    }
    if ($_POST['image']  === '') {
        $plant_data['image'] = getPlantImage($db,$_SESSION['id'])['image'];
    }
    if ($_POST['plant_type']  === '') {
        $plant_data['plant_type'] = getPlantType($db,$_SESSION['id'])['type'];
    }
    $same_entry = checkforUniqueEditEntry($db,$plant_data);
    if ($same_entry) {
        header('Location: editpage.php?entry_edit_error=1');
    } else {
        $nonunique_entry = checkforUniqueAddEntry($db, $plant_data['science_name'], $plant_data['common_name']);
        if ($nonunique_entry['id'] === 0 || $nonunique_entry['id'] === $_SESSION['id']) {
            $dbEditCheck = editDBData($db, $plant_data);
            if ($dbEditCheck) {
                header('Location: index.php?entry_edit_successful=1');
            } else {
                header('Location: editpage.php?entry_edit_error=3');
            }
        } else {
            header('Location: editpage.php?entry_edit_error=2');
        }
    }
}



