<h3><?= $editando ? 'Editar Cliente' : 'Registrar Nuevo Cliente' ?></h3>
<form action="index.php" method="POST">
    <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= $clienteEdit->id ?>">
    <?php endif; ?>
    
    <div class="form-group">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $editando ? htmlspecialchars($clienteEdit->nombre) : '' ?>" required>
    </div>
    
    <div class="form-group">
        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?= $editando ? htmlspecialchars($clienteEdit->apellido) : '' ?>" required>
    </div>

    <div class="form-group">
        <label>Fecha de Nacimiento:</label>
        <input type="text" name="fecha_nacimiento" placeholder="MM/DD/YYYY" value="<?= $editando ? htmlspecialchars($clienteEdit->getFechaNacimientoFormateada()) : '' ?>" required>
        <span class="hint">Formato aceptado: Mes/Día/Año (ej. 12/31/1990)</span>
    </div>

    <div class="form-group">
        <label>Teléfono:</label>
        <input type="text" id="telefono_input" name="telefono" maxlength="10" pattern="\d{10}" value="<?= $editando ? htmlspecialchars($clienteEdit->telefono ?? '') : '' ?>" required>
        <span id="telefono_error" class="error-msg">El campo está incompleto. Faltan caracteres.</span>
        <span class="hint">10 dígitos exactos.</span>
    </div>

    <div class="form-group">
        <label>Correo:</label>
        <input type="email" name="correo" value="<?= $editando ? htmlspecialchars($clienteEdit->correo ?? '') : '' ?>" required>
    </div>

    <div class="form-group">
        <label>Ciudad:</label>
        <input type="text" name="ciudad" value="<?= $editando ? htmlspecialchars($clienteEdit->ciudad ?? '') : '' ?>" required>
    </div>
    
    <button type="submit"><?= $editando ? 'Actualizar' : 'Guardar' ?></button>
    <?php if ($editando): ?>
        <a href="?tab=lista">Cancelar</a>
    <?php endif; ?>
</form>
