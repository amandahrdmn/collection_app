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
        <div>
            <input required type="text" name="science_name" placeholder="Scientific Name">
        </div>
        <div>
            <input required type="text" name="common_name" placeholder="Common Name">
        </div>
        <div>
            <select class = 'styled_select' required>
                <?php echo getPlantTypeOptions(getPlantTypes(getDB())) ?>
            </select>
        </div>
        <div>
            <button type="submit">Add Entry</button>
        </div>
    </form>
</section>


