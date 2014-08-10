<?php

session_start();
include_once "lib/php/sql.php";
$sqlControl = new SQL();
$sqlControl2 = new SQL();
$noticias = array();
$noticiasTotal = array();
$obj = array();
$obj['contenido'] = "";
$obj['numResultados'] = 0;
$obj['add'] = false;
$numResultados = 10;

if ($_POST["pagina"]) {
    $limit = ($_POST[pagina] * 10) . " , " . $numResultados;
} else {
    $limit = "0, $numResultados";
}
$noticias = $sqlControl->select($_POST["tabla"], false, false, " ID DESC ", $limit, false);
$noticiasTotal = $sqlControl2->select($_POST["tabla"], false, false, " ID DESC ", false, false);
if ($_SESSION["dato"] != 852456753159) {
    $visibilidadBorrar = "display:none;";
} else {
    $visibilidadBorrar = "";
}
if ($noticias) {
    foreach ($noticias as $key => $noticiaArray) {
        $obj['contenido'] .= "$noticiaArray[Noticia]";
        $obj['contenido'] .= "<div style='$visibilidadBorrar'>"
                . "<a class='borrarPostButton' onclick='eventoBorrarPost($noticiaArray[ID],\"" . $_POST[tabla] . "\")'  >"
                . "<img src='imagenes/delete-black.svg' >"
                . "</a>"
                . "</div>";
        $obj['contenido'] .= "<hr></hr>";
    }
} else {
    $obj['contenido'] .= "<h3>Sin noticias</h3>";
}
$obj['numResultados'] = count($noticiasTotal);
$obj['tabla'] = $_POST["tabla"];
$obj['modo'] = $_POST["modo"];
$obj['pagina'] = $_POST["pagina"];
echo json_encode($obj);
?>