<?php
    require_once 'layout/header.php';
?>
<!-- CONTENT -->
<section class="content">

    <div class="mb-4">
        <h1 class="page-title">Dashboard</h1>
        <p class="text-secondary mb-0">
            Resumen general de la sección administrativa.
        </p>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card dashboard-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary-subtle text-primary">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Usuarios</div>
                        <div class="fs-4 fw-semibold">248</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card dashboard-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success-subtle text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Activos</div>
                        <div class="fs-4 fw-semibold">196</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card dashboard-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-warning-subtle text-warning">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Pendientes</div>
                        <div class="fs-4 fw-semibold">17</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card dashboard-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-info-subtle text-info">
                        <i class="bi bi-activity"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Actividad</div>
                        <div class="fs-4 fw-semibold">1,542</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card dashboard-card">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">Últimos registros</h5>
                <small class="text-secondary">
                    Información de ejemplo para la sección administrativa.
                </small>
            </div>

            <button class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>
                Nuevo registro
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
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Juan Pérez</td>
                            <td>juan@empresa.com</td>
                            <td>
                                <span class="badge text-bg-success">Activo</span>
                            </td>
                            <td>03/10/2026</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>María Rodríguez</td>
                            <td>maria@empresa.com</td>
                            <td>
                                <span class="badge text-bg-warning">Pendiente</span>
                            </td>
                            <td>02/10/2026</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Carlos Gómez</td>
                            <td>carlos@empresa.com</td>
                            <td>
                                <span class="badge text-bg-secondary">Inactivo</span>
                            </td>
                            <td>01/10/2026</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>
        </div>
    </div>

</section>

<?php
    require_once 'layout/footer.php';
?>