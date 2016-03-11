<?php
include('src/Mustache/Autoloader.php');
Mustache_Autoloader::register();
$entry = new Mustache_Engine;
$entry_template = file_get_contents('templates/archive.mustache');
$entry_data = file_get_contents('data/entry.json');

include('includes/header.php');
echo $entry->render($entry_template, json_decode($entry_data, true));
include('includes/footer.php');
?>