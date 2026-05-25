<?php
// Views/layout.php - Plantilla base HTML e inyección de vistas

function mostrarDato($dato) {
    if (empty(trim($dato))) {
        return '<span style="color: #d9534f; font-weight: bold; font-size: 0.9em;">* campo falta</span>';
    }
    return htmlspecialchars($dato);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes (MVC)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { width: 80%; margin: 0 auto; background-color: #fff; padding: 20px; border: 1px solid #ccc; }
        .menu { margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px; }
        .menu a { margin-right: 15px; text-decoration: none; color: blue; }
        .menu a.active { font-weight: bold; color: black; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: inline-block; width: 150px; vertical-align: top; margin-top: 5px; }
        .form-group input { padding: 5px; width: 200px; }
        .hint { display: block; margin-left: 155px; font-size: 12px; color: #666; margin-top: 3px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #999; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #eee; }
        .error-msg { color: #d9534f; font-size: 12px; display: none; margin-left: 155px; margin-top: 3px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Sistema de Clientes (Arquitectura MVC)</h2>
    
    <div class="menu">
        <a href="?tab=bienvenida" class="<?= $activeTab === 'bienvenida' ? 'active' : '' ?>">Bienvenida</a>
        <a href="?tab=formulario" class="<?= $activeTab === 'formulario' ? 'active' : '' ?>"><?= $editando ? 'Editar Cliente' : 'Agregar Cliente' ?></a>
        <a href="?tab=lista" class="<?= $activeTab === 'lista' ? 'active' : '' ?>">Lista de Clientes</a>
    </div>

    <?php
    if ($activeTab === 'bienvenida') {
        require_once __DIR__ . '/bienvenida.php';
    } elseif ($activeTab === 'formulario') {
        require_once __DIR__ . '/formulario.php';
    } elseif ($activeTab === 'lista') {
        require_once __DIR__ . '/lista.php';
    }
    ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var telInput = document.getElementById('telefono_input');
        var telError = document.getElementById('telefono_error');
        if (telInput) {
            telInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/\D/g, '');
                if (this.value.length > 0 && this.value.length < 10) {
                    telError.style.display = 'block';
                } else {
                    telError.style.display = 'none';
                }
            });
        }

        var dateInput = document.querySelector('input[name="fecha_nacimiento"]');
        if (dateInput) {
            dateInput.addEventListener('input', function(e) {
                if (e.inputType === 'deleteContentBackward') return;
                var value = e.target.value.replace(/\D/g, ''); 
                if (value.length > 8) value = value.slice(0, 8); 
                var formattedValue = '';
                if (value.length > 0) formattedValue = value.slice(0, 2); 
                if (value.length > 2) formattedValue += '/' + value.slice(2, 4);
                if (value.length > 4) formattedValue += '/' + value.slice(4, 8);
                e.target.value = formattedValue;
            });
        }
    });
</script>

</body>
</html>
