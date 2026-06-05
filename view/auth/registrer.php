<?php
// registrer.php - Vista del Formulario de Registro de Usuario Autónomo
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AgroStock - Registro de nuevos usuarios para la gestión de insumos agrícolas y facturación.">
    <title>Registro de Usuario - AgroStock</title>
    
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

    <div class="auth-container register-wide">
        <!-- Logo and Title -->
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
                <h2 class="h4 fw-bold mb-1"><i class="fa-solid fa-user-plus text-success me-2"></i>Crear Nueva Cuenta</h2>
                <p class="text-muted fs-7">Regístrate en el sistema para gestionar tus consultas y compras de insumos</p>
            </div>

            <!-- Alerta interactiva de registro (para demostración) -->
            <div class="alert alert-success d-none mb-4 fs-7" role="alert" id="demoRegisterAlert">
                <i class="fa-solid fa-circle-check me-2"></i> ¡Registro exitoso! Redirigiendo al inicio de sesión...
            </div>

            <!-- Formulario de Registro -->
            <form id="authRegisterForm" novalidate>
                <div class="row g-3">
                    <!-- Nombre Completo -->
                    <div class="col-md-6">
                        <label for="regName" class="form-label fs-7 fw-medium">Nombre Completo</label>
                        <div class="input-group">
                            <span class="input-group-text-custom"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control form-control-custom form-control-custom-grouped" id="regName" placeholder="Juan Pérez" required>
                            <div class="invalid-feedback">Por favor ingrese su nombre completo.</div>
                        </div>
                    </div>
                    
                    <!-- Correo Electrónico -->
                    <div class="col-md-6">
                        <label for="regEmail" class="form-label fs-7 fw-medium">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text-custom"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" class="form-control form-control-custom form-control-custom-grouped" id="regEmail" placeholder="juan.perez@correo.com" required>
                            <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
                        </div>
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6">
                        <label for="regPhone" class="form-label fs-7 fw-medium">Número de Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text-custom"><i class="fa-solid fa-phone"></i></span>
                            <input type="tel" class="form-control form-control-custom form-control-custom-grouped" id="regPhone" placeholder="3001234567" required>
                            <div class="invalid-feedback">Ingrese un número telefónico.</div>
                        </div>
                    </div>

                    <!-- Selección de Rol -->
                    <div class="col-md-6">
                        <label for="regRole" class="form-label fs-7 fw-medium">Rol del Sistema</label>
                        <div class="input-group">
                            <span class="input-group-text-custom"><i class="fa-solid fa-user-shield"></i></span>
                            <select class="form-select form-control-custom form-control-custom-grouped" id="regRole" required>
                                <option value="" disabled selected>Selecciona tu rol...</option>
                                <option value="client">Cliente (Consulta y Compras)</option>
                                <option value="seller">Vendedor (Facturación y POS)</option>
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un rol.</div>
                        </div>
                    </div>

                    <!-- Caja dinámica informativa del rol seleccionado -->
                    <div class="col-12 d-none" id="regRoleInfoBox">
                        <div class="p-3 bg-light rounded-3 border border-light-subtle">
                            <small class="text-success fw-bold d-block mb-1" id="regRoleTitle">Rol Seleccionado</small>
                            <small class="text-muted d-block fs-8" id="regRoleDesc">Permisos y alcances.</small>
                        </div>
                    </div>

                    <!-- Contraseña -->
                    <div class="col-md-6">
                        <label for="regPassword" class="form-label fs-7 fw-medium">Contraseña de Acceso</label>
                        <div class="input-group">
                            <span class="input-group-text-custom"><i class="fa-solid fa-key"></i></span>
                            <input type="password" class="form-control form-control-custom form-control-custom-grouped" id="regPassword" placeholder="Mínimo 8 caracteres" required>
                            <div class="invalid-feedback">La contraseña debe tener al menos 8 caracteres.</div>
                        </div>
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="col-md-6">
                        <label for="regPasswordConfirm" class="form-label fs-7 fw-medium">Confirmar Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text-custom"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" class="form-control form-control-custom form-control-custom-grouped" id="regPasswordConfirm" placeholder="Repite tu contraseña" required>
                            <div class="invalid-feedback" id="passConfirmFeedback">Las contraseñas no coinciden.</div>
                        </div>
                    </div>

                    <!-- Aceptación de políticas de stock RN01, RN02 y Términos -->
                    <div class="col-12 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                            <label class="form-check-label text-muted fs-7" for="termsCheck">
                                Acepto los términos de servicio, políticas de privacidad y el cumplimiento de las políticas operativas del sistema (<strong class="text-success">RN01 Control de Stock No Negativo</strong> y <strong class="text-success">RN02 Alertas Críticas</strong>).
                            </label>
                            <div class="invalid-feedback">Debe aceptar las políticas y condiciones para registrarse.</div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary-custom w-100 py-2.5 mt-4" id="btnRegisterSubmit">
                    <i class="fa-solid fa-user-plus me-2"></i> Crear Cuenta e Ingresar
                </button>
            </form>

            <div class="auth-divider">o también</div>

            <div class="text-center">
                <p class="fs-7 text-muted mb-0">
                    ¿Ya posees una cuenta en AgroStock?<br>
                    <a href="login.php" class="text-success fw-bold text-decoration-none ms-1"><i class="fa-solid fa-right-to-bracket fs-8 me-1"></i> Inicia sesión ahora</a>
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
            const authRegisterForm = document.getElementById('authRegisterForm');
            const regName = document.getElementById('regName');
            const regEmail = document.getElementById('regEmail');
            const regPhone = document.getElementById('regPhone');
            const regRole = document.getElementById('regRole');
            const regPassword = document.getElementById('regPassword');
            const regPasswordConfirm = document.getElementById('regPasswordConfirm');
            const termsCheck = document.getElementById('termsCheck');
            const demoRegisterAlert = document.getElementById('demoRegisterAlert');
            const passConfirmFeedback = document.getElementById('passConfirmFeedback');

            const regRoleInfoBox = document.getElementById('regRoleInfoBox');
            const regRoleTitle = document.getElementById('regRoleTitle');
            const regRoleDesc = document.getElementById('regRoleDesc');

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

            // --- Información Dinámica de Rol ---
            regRole.addEventListener('change', () => {
                const selected = regRole.value;
                if (selected === 'client') {
                    regRoleTitle.textContent = 'Perfil de Cliente';
                    regRoleDesc.textContent = 'Podrás buscar y consultar el catálogo de insumos en tiempo real, simular cotizaciones y consultar tu historial de facturas emitidas.';
                    regRoleInfoBox.classList.remove('d-none');
                } else if (selected === 'seller') {
                    regRoleTitle.textContent = 'Perfil de Vendedor';
                    regRoleDesc.textContent = 'Tendrás permisos para operar el Punto de Venta (POS) Atómico, registrar facturas desglosando impuestos de ley y simular el stock operativo del inventario.';
                    regRoleInfoBox.classList.remove('d-none');
                } else {
                    regRoleInfoBox.classList.add('d-none');
                }
            });

            // --- Validación interactiva al escribir ---
            regPasswordConfirm.addEventListener('input', () => {
                if (regPassword.value !== regPasswordConfirm.value) {
                    regPasswordConfirm.classList.add('is-invalid');
                } else {
                    regPasswordConfirm.classList.remove('is-invalid');
                }
            });

            // --- Envío del Formulario (Demostración) ---
            authRegisterForm.addEventListener('submit', (e) => {
                e.preventDefault();
                
                let isValid = true;

                // Validar Nombre
                if (!regName.value.trim()) {
                    regName.classList.add('is-invalid');
                    isValid = false;
                } else {
                    regName.classList.remove('is-invalid');
                }

                // Validar Email
                if (!regEmail.value || !regEmail.value.includes('@')) {
                    regEmail.classList.add('is-invalid');
                    isValid = false;
                } else {
                    regEmail.classList.remove('is-invalid');
                }

                // Validar Teléfono
                if (!regPhone.value.trim()) {
                    regPhone.classList.add('is-invalid');
                    isValid = false;
                } else {
                    regPhone.classList.remove('is-invalid');
                }

                // Validar Rol
                if (!regRole.value) {
                    regRole.classList.add('is-invalid');
                    isValid = false;
                } else {
                    regRole.classList.remove('is-invalid');
                }

                // Validar Contraseña (longitud mínima 8)
                if (!regPassword.value || regPassword.value.length < 8) {
                    regPassword.classList.add('is-invalid');
                    isValid = false;
                } else {
                    regPassword.classList.remove('is-invalid');
                }

                // Validar Confirmación
                if (regPassword.value !== regPasswordConfirm.value) {
                    regPasswordConfirm.classList.add('is-invalid');
                    isValid = false;
                } else {
                    regPasswordConfirm.classList.remove('is-invalid');
                }

                // Validar Términos
                if (!termsCheck.checked) {
                    termsCheck.classList.add('is-invalid');
                    isValid = false;
                } else {
                    termsCheck.classList.remove('is-invalid');
                }

                if (isValid) {
                    // Mostrar alerta de éxito
                    demoRegisterAlert.classList.remove('d-none');
                    
                    // Simular almacenamiento en localStorage (para recordar el rol en la demo si fuese necesario)
                    localStorage.setItem('demo_registered_user', JSON.stringify({
                        name: regName.value,
                        email: regEmail.value,
                        role: regRole.value
                    }));

                    // Simular redirección a la página de login después de 1.5s
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 1500);
                }
            });
        });
    </script>
</body>
</html>
