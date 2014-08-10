<?php
$obj = array();
include_once "lib/php/sql.php";
$sqlControl = new SQL();
$criteriosArray = array();
$criteriosArray[] = "ID = '$_POST[id]'";
$sqlControl->delete($_POST[tabla], $criteriosArray, false);
echo json_encode($obj);
?>