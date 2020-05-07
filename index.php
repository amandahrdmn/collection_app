<?php
require_once('functions.php');
$add_entry_message = '';
if (!empty($_GET['entry_add_successful'])) {
    if ($_GET['entry_add_successful'] === '1') {
        $add_entry_message = '<div class="add_entry_container">Entry addition successful!</div>';
    }
}

if (!empty($_GET['entry_edit_successful'])) {
    if ($_GET['entry_edit_successful'] === '1') {
        $add_entry_message = '<div class="add_entry_container">Entry update successful!</div>';
    }
}

if (!empty($_GET['entry_delete_successful'])) {
    if ($_GET['entry_delete_successful'] === '1') {
        $add_entry_message = '<div class="add_entry_container">Entry deletion successful!</div>';
    }
}

$plant_data = getPlantData(getDB());

echo DBCheck($plant_data);

?>

<!doctype html>
<html lang='en'>
<head>
    <title>collection_app_ahardman</title>
    <link href='normalize.css' rel='stylesheet' type='text/css'>
    <link href='collection_app_ahardman_stylesheet.css' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width">
</head>

<section class='entries'>
    <div class='container'>
        <?php echo $add_entry_message ?>
        <h2>Plant Collection</h2>
        <div class='entry_container')>
                <?php
                    foreach ($plant_data as $entry) {
                        echo makePlantEntryTile($entry);
                    }
                ?>
        </div>
        <form action="addpage.php" method="POST">
            <button type="submit">Add Entry</button>
        </form>
    </div>
</section>

