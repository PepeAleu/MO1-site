<?php
$obj = array();
include_once "lib/php/sql.php";
include_once "lib/php/DOM.php";
$sqlControl = new SQL();
$DOMControl = new DOM();
$noticias = array();
$noticia = addslashes($_POST[dato]);
$sqlControl->insert($_POST[tabla], array("'" . $DOMControl->getIP() . "'", "'$noticia'"), array("Usuario", "Noticia"), false);
echo json_encode($obj);
?>