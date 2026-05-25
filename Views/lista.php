<h3>Lista de Clientes</h3>

<?php if (empty($listaClientes)): ?>
    <p>No hay clientes registrados.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Nacimiento</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Ciudad</th>
                <th>Fecha Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaClientes as $cliente): ?>
                <tr>
                    <td><?= $cliente->id ?></td>
                    <td><?= mostrarDato($cliente->nombre) ?></td>
                    <td><?= mostrarDato($cliente->apellido) ?></td>
                    <td><?= mostrarDato($cliente->getFechaNacimientoFormateada()) ?></td>
                    <td><?= mostrarDato($cliente->telefono) ?></td>
                    <td><?= mostrarDato($cliente->correo) ?></td>
                    <td><?= mostrarDato($cliente->ciudad) ?></td>
                    <td><?= htmlspecialchars($cliente->getFechaCreacionFormateada()) ?></td>
                    <td>
                        <a href="?editar=<?= $cliente->id ?>">Editar</a> | 
                        <a href="?eliminar=<?= $cliente->id ?>" onclick="return confirm('¿Seguro que quieres borrar este cliente?')">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
