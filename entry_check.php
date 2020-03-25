<?php
session_start();

$science_name = $_POST['science_name'];
$name = $_POST['name'];
$type = $_POST['type'];

$db = new PDO('mysql:host=DB;dbname=collection_app', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$nonunique_entry_query = $db->prepare("SELECT `id` FROM `plants` WHERE `science_name` = ? AND `name` = ?;");
$nonunique_entry_query->execute([$science_name, $name]);
$nonunique_entry = $nonunique_entry_query->fetch();
var_dump($nonunique_entry);

$used_type_query = $db->prepare("SELECT `id` FROM `plant_types` WHERE `type` = ?;");
$used_type_query->execute([$type]);
$used_type = $used_type_query->fetch();
var_dump($used_type);

if($nonunique_entry === false && !empty($used_type)) {
    $add_entry_query = $db->prepare("INSERT INTO `plants` (`science_name`,`name`,`type`) VALUES (?,?,?);");
    $add_entry_query->execute([$science_name, $name, $type]);
    header('Location: index.php?entry_add_successful=1');
} else {
    header('Location: addpage.php?entry_add_error=1');
}