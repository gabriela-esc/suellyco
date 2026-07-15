<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suellyco</title>

    <link rel="stylesheet" href="assets/css/global.css?v=2">
    <link rel="stylesheet" href="assets/css/componentes.css">
    <link rel="stylesheet" href="assets/css/navbar.css?v=10">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/perfil.css">
    <link rel="stylesheet" href="assets/css/sesion.css?v=99">
    <link rel="stylesheet" href="assets/css/metricas.css?v=99">
    <link rel="stylesheet" href="assets/css/tareas.css">
    <link rel="stylesheet" href="assets/css/distracciones.css?v=3">
    <link rel="stylesheet" href="assets/css/autenticacion.css?v=21">
</head>

<?php
$ruta_actual = $_GET["ruta"] ?? "inicio";

$clase_body = "";

if (in_array($ruta_actual, ["sesion", "nueva_sesion"])) {
    $clase_body = "body-sesion";
}

if ($ruta_actual === "tareas") {
    $clase_body = "body-tareas";
}

if (in_array($ruta_actual, ["registro", "registrar", "login", "validar_login"])) {
    $clase_body = "body-registro";
}

if ($ruta_actual === "distracciones") {
    $clase_body = "body-distracciones";
}

if ($ruta_actual === "metricas") {
    $clase_body = "body-metricas";
}
?>

<body class="<?php echo $clase_body; ?>">