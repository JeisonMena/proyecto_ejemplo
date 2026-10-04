<?php
//recibir solicitud POST si existe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'config/conexion.php';

    if(isset($_POST['correoIngresado']) && isset($_POST['contrasenaIngresada'])){
        $correoIngresado = mysqli_real_escape_string($conn, $_POST['correoIngresado']);
    
        $contrasenaIngresada = md5($_POST['contrasenaIngresada']);
    
        $resultado = mysqli_query($conn, "SELECT id, correo, contra FROM usuario WHERE correo = '$correoIngresado' LIMIT 1");
        if(mysqli_num_rows($resultado) == 1){
            $assoc_usuario = mysqli_fetch_assoc($resultado);
            if($assoc_usuario['contra'] === $contrasenaIngresada){
                session_start();
                $_SESSION['id'] = $assoc_usuario['id'];
                header("Location: pages/dashboard.php");
                exit();
            } else {
                $error = "Correo o contraseña incorrectos.";
            }
        }else{
            $error = "Correo o contraseña incorrectos.";
        }
    }
}



?>


<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login 04 - Card Art</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style_login.css">
</head>

<body>
    <div class="page">
        <div class="shell">
            <section class="art">
                <div class="shape s1"></div>
                <div class="shape s2"></div>
                <div class="shape s3"></div>

                <div class="brand">
                    <div class="brand-mark"><i class="bi bi-triangle-fill"></i></div>
                    Proyecto de Programacion
                </div>

                <div class="art-copy">
                    <h2 class="display-6 fw-bold">Control administrativo con una experiencia más simple.</h2>
                    <p class="opacity-75 mb-0">Gestiona usuarios, procesos y reportes desde un entorno centralizado.</p>
                </div>
            </section>

            <section class="form-area">
                <div class="form-box">
                    <div class="mb-4">
                        <div class="text-secondary small mb-2">Portal de administración</div>
                        <h1 class="h2 fw-bold">Inicia sesión</h1>
                        <p class="text-secondary">Usa tus credenciales asignadas.</p>
                    </div>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label">Correo</label>
                            <input name="correoIngresado" type="email" class="form-control" placeholder="usuario@empresa.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input name="contrasenaIngresada" type="password" class="form-control" placeholder="Contraseña" required>
                        </div>

                        <?php
                            if(isset($error)){
                                echo '<div class="alert alert-danger">'.$error.'</div>';
                            }
                        ?>

                        <button class="btn btn-primary w-100">Ingresar al sistema</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>