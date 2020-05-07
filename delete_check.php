<?php
require_once('functions.php');
session_start();
$db = getDB();

if (empty($_POST['id'])) {
    header('Location: index.php');
} else {
    $delete_check = deleteEntry($db, $_POST['id']);

    if ($delete_check) {
        header('Location: index.php?entry_delete_successful=1');
    } else {
        header('Location: deletepage.php?entry_delete_error=1');
    }
}



