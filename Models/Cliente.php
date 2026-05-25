<?php
// Models/Cliente.php - Modelo de Datos y Lógica de Negocio (POO)

class Cliente {
    public $id;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $telefono;
    public $correo;
    public $ciudad;
    public $fecha_creacion;

    public function __construct($id, $nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $ciudad, $fecha_creacion = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha_nacimiento = self::parsearFecha($fecha_nacimiento);
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->ciudad = $ciudad;
        $this->fecha_creacion = $fecha_creacion ?? date('Y-m-d H:i:s');
    }

    public static function parsearFecha($fecha) {
        if (empty($fecha)) return '';
        
        if (preg_match('/^(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})$/', $fecha, $matches)) {
            $mes = $matches[1];
            $dia = $matches[2];
            $anio = $matches[3];
            return sprintf('%04d-%02d-%02d', $anio, $mes, $dia);
        }
        
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            return $fecha;
        }
        
        $timestamp = strtotime($fecha);
        if ($timestamp !== false) {
            return date('Y-m-d', $timestamp);
        }
        
        return $fecha;
    }

    public function getFechaNacimientoFormateada() {
        if (empty($this->fecha_nacimiento)) return '';
        $timestamp = strtotime($this->fecha_nacimiento);
        return $timestamp !== false ? date('m/d/Y', $timestamp) : $this->fecha_nacimiento;
    }

    public function getFechaCreacionFormateada() {
        if (empty($this->fecha_creacion)) return '';
        $timestamp = strtotime($this->fecha_creacion);
        return $timestamp !== false ? date('m/d/Y H:i', $timestamp) : $this->fecha_creacion;
    }

    public static function initSession() {
        if (!isset($_SESSION['clientes'])) {
            $_SESSION['clientes'] = [];
        }
        if (!isset($_SESSION['next_id'])) {
            $_SESSION['next_id'] = 1;
        }
    }

    public static function crear($nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $ciudad) {
        self::initSession();
        $id = $_SESSION['next_id']++;
        $nuevoCliente = new self($id, $nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $ciudad);
        $_SESSION['clientes'][] = $nuevoCliente;
    }

    public static function obtenerTodos() {
        self::initSession();
        return $_SESSION['clientes'];
    }

    public static function obtenerPorId($id) {
        self::initSession();
        foreach ($_SESSION['clientes'] as $cliente) {
            if ($cliente->id == $id) {
                return $cliente;
            }
        }
        return null;
    }

    public static function actualizar($id, $nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $ciudad) {
        self::initSession();
        foreach ($_SESSION['clientes'] as $key => $cliente) {
            if ($cliente->id == $id) {
                $_SESSION['clientes'][$key]->nombre = $nombre;
                $_SESSION['clientes'][$key]->apellido = $apellido;
                $_SESSION['clientes'][$key]->fecha_nacimiento = self::parsearFecha($fecha_nacimiento);
                $_SESSION['clientes'][$key]->telefono = $telefono;
                $_SESSION['clientes'][$key]->correo = $correo;
                $_SESSION['clientes'][$key]->ciudad = $ciudad;
                break;
            }
        }
    }

    public static function eliminar($id) {
        self::initSession();
        foreach ($_SESSION['clientes'] as $key => $cliente) {
            if ($cliente->id == $id) {
                unset($_SESSION['clientes'][$key]);
                break;
            }
        }
        $_SESSION['clientes'] = array_values($_SESSION['clientes']);
    }
}
