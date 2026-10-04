<?php
    $paginaActual = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Administrativo</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style_admin.css">

</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="app">

        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">

            <div class="sidebar-brand">
                <div class="brand-icon">
                    <i class="bi bi-grid-fill"></i>
                </div>

                <div class="brand-text">
                    Admin Panel
                </div>
            </div>

            <?php require 'sidebar.php'; ?>
        </aside>

        <!-- MAIN -->
        <main class="main">

            <!-- HEADER -->
            <header class="topbar">

                <button
                    type="button"
                    class="btn btn-light border me-3"
                    id="btnSidebar"
                    aria-label="Mostrar u ocultar menú">
                    <i class="bi bi-list fs-5"></i>
                </button>

                <div class="search-box">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            class="form-control bg-light border-start-0"
                            placeholder="Buscar...">
                    </div>
                </div>

                <div class="ms-auto">

                    <div class="dropdown">
                        <button
                            class="btn btn-light border dropdown-toggle d-flex align-items-center gap-2"
                            data-bs-toggle="dropdown"
                            type="button">
                            <div
                                class="rounded-circle bg-primary text-white d-grid"
                                style="width:34px;height:34px;place-items:center;">
                                <i class="bi bi-person"></i>
                            </div>

                            <span class="d-none d-md-inline">
                                Administrador
                            </span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person me-2"></i>
                                    Mi perfil
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-gear me-2"></i>
                                    Configuración
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item text-danger" href="#">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </header>