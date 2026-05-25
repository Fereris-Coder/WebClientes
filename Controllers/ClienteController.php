<?php
// Controllers/ClienteController.php - Intermediario entre Modelo y Vista

require_once __DIR__ . '/../Models/Cliente.php';

class ClienteController {
    
    public function __construct() {
        Cliente::initSession();
    }

    public function handleRequest() {
        if (isset($_GET['eliminar'])) {
            Cliente::eliminar($_GET['eliminar']);
            header('Location: index.php?tab=lista');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $ciudad = $_POST['ciudad'] ?? '';
            
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                Cliente::actualizar($_POST['id'], $nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $ciudad);
            } else {
                Cliente::crear($nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $ciudad);
            }
            header('Location: index.php?tab=lista');
            exit;
        }

        $editando = false;
        $clienteEdit = null;
        if (isset($_GET['editar'])) {
            $clienteBuscado = Cliente::obtenerPorId($_GET['editar']);
            if ($clienteBuscado) {
                $editando = true;
                $clienteEdit = $clienteBuscado;
            }
        }

        $activeTab = $_GET['tab'] ?? ($editando ? 'formulario' : 'bienvenida');
        $listaClientes = Cliente::obtenerTodos();

        require_once __DIR__ . '/../Views/layout.php';
    }
}
