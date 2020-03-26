<?php
require_once('functions.php');

$error_message = '';
if (!empty($_GET['entry_add_error'])) {
    $error_message = '<div class="error container">' . getErrorMessage($_GET['entry_add_error']) . '</div>';
}

?>

<!doctype html>
<html lang='en'>
<head>
    <title>collection_app_ahardman</title>
    <link href='normalize.css' rel='stylesheet' type='text/css'>
    <link href='collection_app_new_entry_stylesheet.css' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width">
</head>

<?php echo $error_message ?>
<section class= 'adding container'>
    <h2>Add Entry</h2>
    <form id='add_entry' action="entry_check.php" method="POST" >
            <input required type="text" name="science_name" placeholder="Scientific Name">
            <input required type="text" name="common_name" placeholder="Common Name">
            <input required type="text" name="image" placeholder="Image URL">
            <select id="styled_select" required name='type' class='styled_select'>
                <?php echo getPlantTypeOptions(getPlantTypes(getDB())) ?>
            </select>
            <button type="submit">Add Entry</button>
    </form>
</section>


