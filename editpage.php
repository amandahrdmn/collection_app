<?php
require_once('functions.php');

session_start();

if (!empty($_POST['entry_number'])) {
    $_SESSION['id'] = $_POST['entry_number'];
    $entry_data = getPlantDataForEntry(getDB(),$_POST['entry_number']);
} elseif (!empty($_SESSION['id'])) {
    $entry_data = getPlantDataForEntry(getDB(),$_SESSION['id']);
} else {
    header('Location: index.php');
}

$error_message = '';
if (!empty($_GET['entry_edit_error'])) {
    $error_message = '<div class="error container">' . getErrorMessageEdit($_GET['entry_edit_error']) . '</div>';
}

?>

<!doctype html>
<html lang='en'>
<head>
    <title>collection_app_ahardman</title>
    <link href='normalize.css' rel='stylesheet' type='text/css'>
    <link href='collection_app_edit_entry_stylesheet.css' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width">
</head>

<?php echo $error_message ?>
<section class= 'adding container'>
    <h2>Edit Entry</h2>
    <form id='edit_entry' action="edit_check.php" method="POST" >
        <div class='label' for="science_name">Current Scientific Name:</div>
        <div class='current_value'><?php echo $entry_data['science_name'] ?></div>
        <input id="science_name" type="text" name="science_name" placeholder="Scientific Name">

        <div class='label' for="common_name">Current Common Name:</div>
        <div class='current_value'> <?php echo $entry_data['name'] ?></div>
        <input id="common_name" type="text" name="common_name" placeholder="Common Name">

        <div class='label image' for="image_url">Current Image URL:</div>
        <div class='current_value image'> <?php echo $entry_data['image'] ?></div>
        <input  id="image_url" type="text" name="image" placeholder="Image URL">

        <div class='label' for="styled_select">Current Type:</div>
        <div class='current_value'><?php echo ucwords(strtolower($entry_data['type']), '/ -') ?></div>
        <select id="styled_select" name='plant_type' class='styled_select'>
            <?php echo getPlantTypeOptions(getPlantTypes(getDB())) ?>
        </select>
        <button class="edit_button" name='id' type="submit">Update</button>
    </form>
</section>
