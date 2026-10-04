            <nav class="sidebar-menu">

                <div class="menu-title">Principal</div>

                <a href="dashboard.php" class="nav-link <?= $paginaActual === 'dashboard.php' ? 'active' : '' ?>" title="Dashboard">
                    <i class="bi bi-speedometer2"></i>
                    <span class="menu-text">Dashboard</span>
                </a>

                <a href="usuarios.php" class="nav-link <?= $paginaActual === 'usuarios.php' ? 'active' : '' ?>" title="Usuarios">
                    <i class="bi bi-people"></i>
                    <span class="menu-text">Usuarios</span>
                </a>

                <a href="#" class="nav-link" title="Empresas">
                    <i class="bi bi-building"></i>
                    <span class="menu-text">Empresas</span>
                </a>

                <a href="#" class="nav-link" title="Registros">
                    <i class="bi bi-file-earmark-text"></i>
                    <span class="menu-text">Registros</span>
                </a>

                <div class="menu-title mt-3">Administración</div>

                <a href="#" class="nav-link" title="Roles y permisos">
                    <i class="bi bi-shield-lock"></i>
                    <span class="menu-text">Roles y permisos</span>
                </a>

                <a href="#" class="nav-link" title="Configuración">
                    <i class="bi bi-gear"></i>
                    <span class="menu-text">Configuración</span>
                </a>

                <a href="#" class="nav-link" title="Auditoría">
                    <i class="bi bi-clock-history"></i>
                    <span class="menu-text">Auditoría</span>
                </a>

            </nav>