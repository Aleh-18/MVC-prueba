<?php
require_once __DIR__ . '/controladores/cUsuario.php';

$controller = new Controlador();

$id = $_GET['id'] ?? null;

$controller->vistaModificar($id);

?>
