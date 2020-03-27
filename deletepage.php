<?php
session_start();

require_once('functions.php');

$error_message = '';
if (!empty($_GET['entry_delete_error'])) {
    $error_message = '<div class="error container">Something when wrong. Please refresh and try again.</div>';
}

?>
<!doctype html>
<html lang='en'>
<head>
    <title>collection_app_ahardman_deletepage</title>
    <link href='normalize.css' rel='stylesheet' type='text/css'>
    <link href='collection_app_delete_entry_stylesheet.css' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width">
</head>

<?php echo $error_message ?>

<section class='adding container'>
    <h2>Are you sure you want to delete this entry?</h2>
    <?php echo removeTileButtons(makePlantEntryTile(getPlantDataForEntry(getDB(),$_POST['entry_number']))); ?>
    <form id='delete_entry' action="delete_check.php" method="POST" >
        <button class="delete_button" name='id' type="submit" value=" <?php echo $_POST['entry_number'] ?>">Yes</button>
        <button class="return_button" formaction="index.php">No</button>
    </form>
