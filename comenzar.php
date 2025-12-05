<?php
require_once __DIR__ . '/controladores/Controlador.php';

$controller = new Controlador();

$accion = $_POST['accion'] ?? null;
$id = $_GET['id'] ?? null;

    if ($accion === 'login') {
        $controller->funcionLogearse($id);
    } elseif ($accion === 'modificarHobbies') {
        $controller->vistaModificar($id);
    } elseif ($accion === 'guardarHobbies') {
        $controller->vistaModificado($id);
    }
?>