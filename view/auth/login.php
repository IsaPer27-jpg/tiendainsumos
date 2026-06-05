<?php
// login.php - Vista del Formulario de Inicio de Sesión Autónomo
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AgroStock - Acceso seguro al sistema de gestión de inventarios y control de insumos agrícolas.">
    <title>Iniciar Sesión - AgroStock</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- FontAwesome 6 for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body class="auth-body">

    <!-- Theme Switcher Positioned top-right -->
    <div class="position-absolute top-0 end-0 p-3 mt-2 me-2">
        <button class="theme-switch-btn" id="themeToggleBtn" aria-label="Cambiar tema visual" title="Cambiar Tema Claro/Oscuro">
            <i class="fa-solid fa-moon"></i>
        </button>
    </div>

    <div class="auth-container">
        <!-- Logo and Return link -->
        <div class="text-center mb-4">
            <a href="../../public/index.php" class="auth-logo-link">
                <i class="fa-solid fa-seedling text-success"></i>
                <span>AgroStock</span>
            </a>
            <p class="text-muted mt-2 fs-7">Control Inteligente de Insumos Agrícolas</p>
        </div>

        <!-- Glassmorphism Card -->
        <div class="auth-card">
            <div class="text-center mb-4">
                <h2 class="h4 fw-bold mb-1"><i class="fa-solid fa-user-lock text-success me-2"></i>Acceso al Sistema</h2>
                <p class="text-muted fs-7">Selecciona un perfil o ingresa tus credenciales registradas</p>
            </div>

            <!-- Fichas de Roles para autoselección (RBAC) -->
            <div class="row g-2 mb-4">
                <div class="col-4">
                    <div class="role-select-card py-2 px-1" data-role="admin" id="roleCardAdmin" tabindex="0" role="button" aria-label="Seleccionar Administrador">
                        <i class="fa-solid fa-user-shield fs-5 d-block mb-1"></i>
                        <span class="fs-8 fw-bold d-block">Admin</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="role-select-card py-2 px-1" data-role="seller" id="roleCardSeller" tabindex="0" role="button" aria-label="Seleccionar Vendedor">
                        <i class="fa-solid fa-cash-register fs-5 d-block mb-1"></i>
                        <span class="fs-8 fw-bold d-block">Vendedor</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="role-select-card py-2 px-1" data-role="client" id="roleCardClient" tabindex="0" role="button" aria-label="Seleccionar Cliente">
                        <i class="fa-solid fa-circle-user fs-5 d-block mb-1"></i>
                        <span class="fs-8 fw-bold d-block">Cliente</span>
                    </div>
                </div>
            </div>

            <!-- Caja dinámica de permisos de rol -->
            <div class="p-3 mb-4 bg-light rounded-3 d-none border border-light-subtle" id="roleInfoBox">
                <h6 class="fw-bold text-success mb-1 fs-7" id="roleInfoTitle">Perfil Seleccionado</h6>
                <p class="mb-0 fs-8 text-secondary" id="roleInfoDesc">Resumen de permisos y accesos.</p>
            </div>

            <!-- Alerta interactiva de login (para demostración) -->
            <div class="alert alert-success d-none mb-3 fs-7" role="alert" id="demoLoginAlert">
                <i class="fa-solid fa-circle-check me-2"></i><span id="demoAlertMsg"></span>
            </div>

            <!-- Formulario de Login -->
            <form id="authLoginForm" novalidate>
                <div class="mb-3">
                    <label for="loginEmail" class="form-label fs-7 fw-medium">Correo Electrónico de Acceso</label>
                    <div class="input-group">
                        <span class="input-group-text-custom"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" class="form-control form-control-custom form-control-custom-grouped" id="loginEmail" placeholder="correo@ejemplo.com" required>
                        <div class="invalid-feedback">Por favor ingrese un correo válido.</div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="loginPassword" class="form-label fs-7 fw-medium mb-0">Contraseña de Seguridad</label>
                        <a href="#" class="fs-8 text-success text-decoration-none" id="forgotPassLink">¿La olvidaste?</a>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text-custom"><i class="fa-solid fa-key"></i></span>
                        <input type="password" class="form-control form-control-custom form-control-custom-grouped" id="loginPassword" placeholder="Contraseña cifrada..." required>
                        <button class="btn btn-outline-secondary border border-start-0 border-light-subtle rounded-end" type="button" id="togglePasswordBtn" style="border-top-right-radius: 10px !important; border-bottom-right-radius: 10px !important; background-color: var(--bg-primary); color: var(--text-muted);">
                            <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                        </button>
                        <div class="invalid-feedback">Por favor ingrese su contraseña.</div>
                    </div>
                </div>
                
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="" id="rememberMeCheck">
                    <label class="form-check-label text-muted fs-7" for="rememberMeCheck">
                        Recordar sesión en este equipo (20 min)
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary-custom w-100 py-2.5 mb-3" id="btnLoginSubmit">
                    <i class="fa-solid fa-shield-halved me-2"></i> Iniciar Sesión
                </button>
            </form>

            <div class="auth-divider">o también</div>

            <div class="text-center">
                <p class="fs-7 text-muted mb-0">
                    ¿Eres nuevo en la plataforma?<br>
                    <a href="registrer.php" class="text-success fw-bold text-decoration-none ms-1">Regístrate como nuevo usuario <i class="fa-solid fa-arrow-right fs-8 ms-1"></i></a>
                </p>
            </div>
        </div>

        <!-- Botón Volver al inicio -->
        <div class="text-center mt-4">
            <a href="../../public/index.php" class="auth-link-back">
                <i class="fa-solid fa-arrow-left"></i> Volver a la página principal
            </a>
        </div>
    </div>

    <!-- Bootstrap 5.3 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Custom Page Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- Credenciales preconfiguradas ---
            const roleCredentials = {
                admin: {
                    email: 'admin@agrostock.com',
                    password: 'AdminSecure8.3',
                    title: 'Perfil Administrador',
                    desc: 'Acceso total a configuraciones, logs, control de costos, reportes de rentabilidad y gestión de usuarios (CRUD).'
                },
                seller: {
                    email: 'vendedor@agrostock.com',
                    password: 'VentasPass2026',
                    title: 'Perfil Vendedor',
                    desc: 'Acceso directo al Punto de Venta (POS) en mostrador, facturación electrónica digital y consulta de stock.'
                },
                client: {
                    email: 'ruben.delgado@cliente.com',
                    password: 'Cliente2026Pass',
                    title: 'Perfil Cliente',
                    desc: 'Interfaz de consulta para revisar la disponibilidad del catálogo de insumos y descargar facturas.'
                }
            };

            const roleCards = document.querySelectorAll('.role-select-card');
            const loginEmailInput = document.getElementById('loginEmail');
            const loginPasswordInput = document.getElementById('loginPassword');
            const roleInfoBox = document.getElementById('roleInfoBox');
            const roleInfoTitle = document.getElementById('roleInfoTitle');
            const roleInfoDesc = document.getElementById('roleInfoDesc');
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');
            const demoLoginAlert = document.getElementById('demoLoginAlert');
            const demoAlertMsg = document.getElementById('demoAlertMsg');
            const authLoginForm = document.getElementById('authLoginForm');

            // --- Inicialización del Tema ---
            const themeToggleBtn = document.getElementById('themeToggleBtn');
            const themeIcon = themeToggleBtn.querySelector('i');
            
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-theme');
                themeIcon.className = 'fa-solid fa-sun';
            } else {
                document.body.classList.remove('dark-theme');
                themeIcon.className = 'fa-solid fa-moon';
            }

            themeToggleBtn.addEventListener('click', () => {
                document.body.classList.toggle('dark-theme');
                const isDark = document.body.classList.contains('dark-theme');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                themeIcon.className = isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
            });

            // --- Selector de Roles ---
            roleCards.forEach(card => {
                card.addEventListener('click', () => {
                    roleCards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    
                    const role = card.getAttribute('data-role');
                    const creds = roleCredentials[role];
                    
                    if (creds) {
                        loginEmailInput.value = creds.email;
                        loginPasswordInput.value = creds.password;
                        
                        // Remover clases de validación anteriores
                        loginEmailInput.classList.remove('is-invalid');
                        loginPasswordInput.classList.remove('is-invalid');
                        
                        roleInfoTitle.textContent = creds.title;
                        roleInfoDesc.textContent = creds.desc;
                        roleInfoBox.classList.remove('d-none');
                    }
                });
            });

            // --- Mostrar/Ocultar Contraseña ---
            togglePasswordBtn.addEventListener('click', () => {
                const isPassword = loginPasswordInput.getAttribute('type') === 'password';
                loginPasswordInput.setAttribute('type', isPassword ? 'text' : 'password');
                togglePasswordIcon.className = isPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
            });

            // --- Envío del Formulario (Demostración) ---
            authLoginForm.addEventListener('submit', (e) => {
                e.preventDefault();
                
                let isValid = true;

                // Validación de email
                if (!loginEmailInput.value || !loginEmailInput.value.includes('@')) {
                    loginEmailInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    loginEmailInput.classList.remove('is-invalid');
                }

                // Validación de contraseña
                if (!loginPasswordInput.value) {
                    loginPasswordInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    loginPasswordInput.classList.remove('is-invalid');
                }

                if (isValid) {
                    demoAlertMsg.textContent = `¡Inicio de sesión exitoso! Accediendo como ${loginEmailInput.value}...`;
                    demoLoginAlert.classList.remove('d-none');
                    
                    // Simular redirección a la página principal
                    setTimeout(() => {
                        window.location.href = '../../public/index.php';
                    }, 1500);
                }
            });

            // Enlace recuperar contraseña
            document.getElementById('forgotPassLink').addEventListener('click', (e) => {
                e.preventDefault();
                alert('La funcionalidad de recuperación de contraseña ha sido simulada. En un entorno de producción, se enviaría un enlace de restablecimiento al correo ingresado.');
            });
        });
    </script>
</body>
</html>
