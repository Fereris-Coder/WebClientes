<?php
// index.php - Front Controller (Punto de entrada de la aplicación MVC)
session_start();

require_once __DIR__ . '/Controllers/ClienteController.php';

$controller = new ClienteController();
$controller->handleRequest();
