<?php
require_once('functions.php');
$db = getDB();
$plant_type_list = listPlantTypes(getPlantTypes($db));

$error_message = '';
$types_message = "<div class=\"types container\">" . $plant_type_list . "</div>";

if (!empty($_GET['entry_add_error'])) {
    $error_number = $_GET['entry_add_error'];
    $error_message = '<div class="error container">' . getErrorMessage($error_number) . '</div>';
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
            <input required type="text" name="type" placeholder="Plant Type">
        </div>
        <div>
            <button type="submit">Add Entry</button>
        </div>
    </form>
</section>
<?php echo $types_message ?>


