<?php
require_once '../config/conexion.php';

$mensaje = '';
$tipoMensaje = '';

// Procesar acciones enviadas por POST (crear, editar, eliminar)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'crear') {
        $nombre = trim($_POST['nombre'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $contrasena = $_POST['contrasena'] ?? '';

        if ($nombre === '' || $correo === '' || $contrasena === '') {
            $mensaje = "Todos los campos son obligatorios.";
            $tipoMensaje = "danger";
        } else {
            $nombreEsc = mysqli_real_escape_string($conn, $nombre);
            $correoEsc = mysqli_real_escape_string($conn, $correo);
            $contraHash = md5($contrasena);

            $verificar = mysqli_query($conn, "SELECT id FROM usuario WHERE correo = '$correoEsc' LIMIT 1");
            if (mysqli_num_rows($verificar) > 0) {
                $mensaje = "Ya existe un usuario registrado con ese correo.";
                $tipoMensaje = "danger";
            } else {
                mysqli_query($conn, "INSERT INTO usuario (nombre, correo, contra) VALUES ('$nombreEsc', '$correoEsc', '$contraHash')");
                header("Location: usuarios.php?ok=creado");
                exit();
            }
        }
    } elseif ($accion === 'editar') {
        $id = (int) ($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $contrasena = $_POST['contrasena'] ?? '';

        if ($id <= 0 || $nombre === '' || $correo === '') {
            $mensaje = "Todos los campos son obligatorios.";
            $tipoMensaje = "danger";
        } else {
            $nombreEsc = mysqli_real_escape_string($conn, $nombre);
            $correoEsc = mysqli_real_escape_string($conn, $correo);

            $verificar = mysqli_query($conn, "SELECT id FROM usuario WHERE correo = '$correoEsc' AND id <> $id LIMIT 1");
            if (mysqli_num_rows($verificar) > 0) {
                $mensaje = "Ya existe otro usuario registrado con ese correo.";
                $tipoMensaje = "danger";
            } else {
                if ($contrasena !== '') {
                    $contraHash = md5($contrasena);
                    mysqli_query($conn, "UPDATE usuario SET nombre = '$nombreEsc', correo = '$correoEsc', contra = '$contraHash' WHERE id = $id");
                } else {
                    mysqli_query($conn, "UPDATE usuario SET nombre = '$nombreEsc', correo = '$correoEsc' WHERE id = $id");
                }
                header("Location: usuarios.php?ok=editado");
                exit();
            }
        }
    } elseif ($accion === 'eliminar') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            mysqli_query($conn, "DELETE FROM usuario WHERE id = $id");
        }
        header("Location: usuarios.php?ok=eliminado");
        exit();
    }
}

// Mensajes de confirmación luego de una redirección
if (isset($_GET['ok'])) {
    $tipoMensaje = "success";
    switch ($_GET['ok']) {
        case 'creado':
            $mensaje = "Usuario creado correctamente.";
            break;
        case 'editado':
            $mensaje = "Usuario actualizado correctamente.";
            break;
        case 'eliminado':
            $mensaje = "Usuario eliminado correctamente.";
            break;
    }
}

$usuarios = mysqli_query($conn, "SELECT id, nombre, correo, fecha_creacion FROM usuario ORDER BY id DESC");

require_once 'layout/header.php';
?>
<!-- CONTENT -->
<section class="content">

    <div class="mb-4 d-flex justify-content-between align-items-start flex-wrap gap-2">
        <div>
            <h1 class="page-title">Mantenimiento de usuarios</h1>
            <p class="text-secondary mb-0">
                Crea, edita y elimina los usuarios con acceso al sistema.
            </p>
        </div>
    </div>

    <?php if ($mensaje !== ''): ?>
        <div class="alert alert-<?= $tipoMensaje ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensaje) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <div class="card dashboard-card">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">Usuarios registrados</h5>
                <small class="text-secondary">
                    Listado de usuarios con acceso al panel administrativo.
                </small>
            </div>

            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">
                <i class="bi bi-plus-lg me-1"></i>
                Nuevo usuario
            </button>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">

                <table class="table align-middle table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Fecha de creación</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (mysqli_num_rows($usuarios) === 0): ?>
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-4">
                                    No hay usuarios registrados todavía.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php while ($usuario = mysqli_fetch_assoc($usuarios)): ?>
                                <tr>
                                    <td><?= (int) $usuario['id'] ?></td>
                                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                                    <td><?= htmlspecialchars($usuario['correo']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($usuario['fecha_creacion'])) ?></td>
                                    <td class="text-end">
                                        <button
                                            class="btn btn-sm btn-outline-primary"
                                            type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditarUsuario<?= (int) $usuario['id'] ?>"
                                            title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button
                                            class="btn btn-sm btn-outline-danger"
                                            type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEliminarUsuario<?= (int) $usuario['id'] ?>"
                                            title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- MODAL EDITAR -->
                                <div class="modal fade" id="modalEditarUsuario<?= (int) $usuario['id'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="usuarios.php" class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar usuario</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>

                                            <div class="modal-body">
                                                <input type="hidden" name="accion" value="editar">
                                                <input type="hidden" name="id" value="<?= (int) $usuario['id'] ?>">

                                                <div class="mb-3">
                                                    <label class="form-label">Nombre</label>
                                                    <input
                                                        type="text"
                                                        name="nombre"
                                                        class="form-control"
                                                        value="<?= htmlspecialchars($usuario['nombre']) ?>"
                                                        required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Correo</label>
                                                    <input
                                                        type="email"
                                                        name="correo"
                                                        class="form-control"
                                                        value="<?= htmlspecialchars($usuario['correo']) ?>"
                                                        required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Nueva contraseña</label>
                                                    <input
                                                        type="password"
                                                        name="contrasena"
                                                        class="form-control"
                                                        placeholder="Dejar en blanco para no modificarla">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- MODAL ELIMINAR -->
                                <div class="modal fade" id="modalEliminarUsuario<?= (int) $usuario['id'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="usuarios.php" class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminar usuario</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>

                                            <div class="modal-body">
                                                <input type="hidden" name="accion" value="eliminar">
                                                <input type="hidden" name="id" value="<?= (int) $usuario['id'] ?>">
                                                ¿Seguro que deseas eliminar al usuario
                                                <strong><?= htmlspecialchars($usuario['nombre']) ?></strong>?
                                                Esta acción no se puede deshacer.
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>

                    </tbody>

                </table>

            </div>
        </div>
    </div>

</section>

<!-- MODAL CREAR -->
<div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="usuarios.php" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="accion" value="crear">

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" placeholder="usuario@empresa.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar usuario</button>
            </div>
        </form>
    </div>
</div>

<?php
    require_once 'layout/footer.php';
?>
