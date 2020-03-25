<?php
require_once('functions.php');
$db = getDB();
$plant_type_list = listPlantTypes(getPlantTypes($db));

$error_message = '';
$types_message = '';

if (!empty($_GET)) {
    if ($_GET['entry_add_error'] === '1') {
        $error_message = '<div class="error container">Please enter data for all fields.</div>';
    } elseif ($_GET['entry_add_error'] === '2') {
        $error_message = '<div class="error container">Oops! Something went wrong. Please try again.</div>';
    } elseif ($_GET['entry_add_error'] === '3') {
        $error_message = "<div class=\"error container\">The plant type given wasn't recognised. 
                      Please select from the list of possible types and try again.</div>";
        $types_message = "<div class=\"types container\">" . $plant_type_list . "</div>";
    }  elseif ($_GET['entry_add_error'] === '4') {
        $error_message = '<div class="error container">This entry has already been added.</div>';
    }
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
            <input type="text" name="science_name" placeholder="Scientific Name">
        </div>
        <div>
            <input type="text" name="name" placeholder="Common Name">
        </div>
        <div>
            <input type="text" name="type" placeholder="Plant Type">
        </div>
        <div>
            <button type="submit">Add Entry</button>
        </div>
    </form>
</section>
<?php echo $types_message ?>


