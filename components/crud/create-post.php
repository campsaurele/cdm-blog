<?php

require_once(__DIR__.'/../../config/bdd_connect.php');
require_once(__DIR__.'/../function/transformPlaceholder.php');

$postData = $_POST;

$stringData = trim(strip_tags(implode(", ", array_keys($postData))));
$holderData = trim(strip_tags(implode(", ", array_map('transformPlaceholder', array_keys($postData)))));

$table = $_GET['t'];

echo $stringData."<br>".$holderData."<br>";
var_dump($postData);

$SQLquery =  "INSERT INTO $table($stringData) VALUES ($holderData)";
