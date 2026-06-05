<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AgroStock - Sistema integral y profesional para el control de inventario, stock crítico, trazabilidad de lotes y ventas de insumos agrícolas. Construido con PHP 8.3, MySQL 8.0 y arquitectura MVC.">
    <title>AgroStock - Sistema de Stock de Inventario y Ventas de Insumos Agrícolas</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- FontAwesome 6 for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- --- NAV BAR --- -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand navbar-brand-logo" href="#" id="brandLogo">
                <i class="fa-solid fa-seedling text-success"></i>
                <span>AgroStock</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation" id="navbarTogglerBtn">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom active" href="#inicio" id="navLinkInicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#modulos" id="navLinkModulos">Módulos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#simulador" id="navLinkSimulador">Simulador Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#calculadora" id="navLinkCalculadora">Calculadora Margen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#contacto" id="navLinkContacto">Contacto</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <!-- Theme Switcher Button -->
                    <button class="theme-switch-btn" id="themeToggleBtn" aria-label="Cambiar tema visual" title="Cambiar Tema Claro/Oscuro">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                    <!-- Access Button -->
                    <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#loginModal" id="btnOpenLogin">
                        <i class="fa-solid fa-right-to-bracket me-2"></i> Ingresar al Sistema
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- --- HERO SECTION --- -->
    <header class="hero-section" id="inicio">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content mb-5 mb-lg-0">
                    <span class="badge bg-success px-3 py-2 rounded-pill fs-6 mb-3"><i class="fa-solid fa-shield-halved me-2"></i>Seguridad y Control Operacional</span>
                    <h1 class="mb-3">Gestión Inteligente de Insumos Agrícolas</h1>
                    <p class="mb-4 text-white-50">
                        Optimice el control de existencias, garantice la trazabilidad de lotes, automatice su facturación legal y obtenga reportes financieros consolidados de margen de utilidad en tiempo real. Construido bajo estándares de PHP 8.3, MySQL 8.0 y arquitectura MVC.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#simulador" class="btn btn-primary-custom btn-lg px-4" id="heroBtnSimular">
                            <i class="fa-solid fa-gears me-2"></i>Probar Simulador
                        </a>
                        <button class="btn btn-outline-light btn-lg px-4 border-2" data-bs-toggle="modal" data-bs-target="#loginModal" id="heroBtnLogin">
                            <i class="fa-solid fa-user-lock me-2"></i>Ver Portales de Roles
                        </button>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Panel rápido de KPIs en el Hero (Glassmorphism) -->
                    <div class="glass-card text-white bg-dark bg-opacity-70 p-4 border border-secondary border-opacity-30">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="h5 mb-0"><i class="fa-solid fa-chart-line text-success me-2"></i>Resumen General</h3>
                            <span class="badge bg-success">En Línea</span>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 bg-white bg-opacity-10 rounded-3">
                                    <small class="text-white-50 d-block mb-1">Ventas del Día</small>
                                    <div class="h3 mb-0 fw-bold text-success" id="kpiTotalSales">142</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-white bg-opacity-10 rounded-3">
                                    <small class="text-white-50 d-block mb-1">Ingreso Diario</small>
                                    <div class="h4 mb-0 fw-bold text-white text-truncate" id="kpiEarnings">$4,892.45</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-white bg-opacity-10 rounded-3" id="kpiAlertsCard">
                                    <small class="text-white-50 d-block mb-1">Alertas Stock Mínimo</small>
                                    <div class="h3 mb-0 fw-bold text-warning" id="kpiAlerts">1</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-white bg-opacity-10 rounded-3">
                                    <small class="text-white-50 d-block mb-1">Productos Catálogo</small>
                                    <div class="h3 mb-0 fw-bold text-info" id="kpiProductsCount">6</div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4 bg-secondary">
                        
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0">
                                <i class="fa-solid fa-circle-check text-success fa-2x"></i>
                            </div>
                            <div>
                                <small class="text-white-50 d-block">Política Operativa RN01</small>
                                <span class="fw-semibold text-white fs-7">Control estricto de Stock. Prohibido Inventario Negativo.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- --- SECCIÓN MÓDULOS DEL SISTEMA --- -->
    <section class="py-5" id="modulos">
        <div class="container py-4">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="text-success fw-bold text-uppercase tracking-wider">Arquitectura Técnica e Ingeniería</span>
                    <h2 class="display-6 fw-bold mt-2 mb-3">Módulos del Sistema de Inventario y Ventas</h2>
                    <p class="text-muted">
                        Diseñado de acuerdo a la Especificación de Requerimientos (SRS) para optimizar el ciclo comercial y logístico de la comercialización de insumos agrícolas.
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Tarjeta 1: Control de Inventario -->
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card h-100 d-flex flex-column justify-content-between" id="cardInventario">
                        <div>
                            <div class="feature-icon-wrapper">
                                <i class="fa-solid fa-warehouse"></i>
                            </div>
                            <h3 class="h5 fw-bold mb-3">Control de Existencias y Alertas</h3>
                            <p class="text-muted fs-7">
                                Registro detallado de productos con código SKU, clasificación jerárquica y alertas visuales automáticas cuando el stock alcanza el umbral de seguridad mínimo. (RF05, RF06)
                            </p>
                        </div>
                        <div class="text-success fw-semibold fs-7 mt-3">Regla de Negocio RN02 vinculada</div>
                    </div>
                </div>

                <!-- Tarjeta 2: Punto de Venta POS -->
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card h-100 d-flex flex-column justify-content-between" id="cardVentas">
                        <div>
                            <div class="feature-icon-wrapper">
                                <i class="fa-solid fa-cash-register"></i>
                            </div>
                            <h3 class="h5 fw-bold mb-3">Punto de Venta POS Atómico</h3>
                            <p class="text-muted fs-7">
                                Ejecución de transacciones de venta bajo un modelo transaccional atómico (ACID) que garantiza consistencia total. Validación y actualización automática de stock al instante. (RF10)
                            </p>
                        </div>
                        <div class="text-success fw-semibold fs-7 mt-3">Validación de stock activa</div>
                    </div>
                </div>

                <!-- Tarjeta 3: Facturación Legal -->
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card h-100 d-flex flex-column justify-content-between" id="cardFacturas">
                        <div>
                            <div class="feature-icon-wrapper">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <h3 class="h5 fw-bold mb-3">Facturación Legal e Impuestos</h3>
                            <p class="text-muted fs-7">
                                Generación secuencial de facturas comerciales con desgloses detallados de base imponible, impuesto sobre las ventas (IVA) y totalización neta. Opción de exportación en PDF. (RF11)
                            </p>
                        </div>
                        <div class="text-success fw-semibold fs-7 mt-3">Cálculo dinámico tributario</div>
                    </div>
                </div>

                <!-- Tarjeta 4: Gestión de Roles (RBAC) -->
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card h-100 d-flex flex-column justify-content-between" id="cardRoles">
                        <div>
                            <div class="feature-icon-wrapper">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                            <h3 class="h5 fw-bold mb-3">Seguridad y Perfiles RBAC</h3>
                            <p class="text-muted fs-7">
                                Control de accesos restringido y seguro mediante roles: Administrador (auditorías y costos), Vendedor (facturación POS) y Cliente (consulta del catálogo y facturas). (RF01, RF02)
                            </p>
                        </div>
                        <div class="text-success fw-semibold fs-7 mt-3">Hasing adaptativo BCRYPT</div>
                    </div>
                </div>

                <!-- Tarjeta 5: Logística y Kardex -->
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card h-100 d-flex flex-column justify-content-between" id="cardLogistica">
                        <div>
                            <div class="feature-icon-wrapper">
                                <i class="fa-solid fa-truck-moving"></i>
                            </div>
                            <h3 class="h5 fw-bold mb-3">Abastecimiento y Kardex</h3>
                            <p class="text-muted fs-7">
                                Registro riguroso de compras a proveedores para aumentar stock y bitácoras para salidas especiales (mermas, daños químicos, vencimientos químicos o ajustes manuales). (RF07, RF08)
                            </p>
                        </div>
                        <div class="text-success fw-semibold fs-7 mt-3">Trazabilidad por número de lote</div>
                    </div>
                </div>

                <!-- Tarjeta 6: Inteligencia y Utilidades -->
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card h-100 d-flex flex-column justify-content-between" id="cardUtilidades">
                        <div>
                            <div class="feature-icon-wrapper">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>
                            <h3 class="h5 fw-bold mb-3">Inteligencia y Utilidad Neta</h3>
                            <p class="text-muted fs-7">
                                Balance transaccional automatizado y cálculo del margen neto empresarial aplicando la fórmula fundamental: Ganancia = Ventas – Costos directos de adquisición. (RF15, RF16)
                            </p>
                        </div>
                        <div class="text-success fw-semibold fs-7 mt-3">Métricas exclusivas de gerencia</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- --- SIMULADOR DE INVENTARIO Y VENTAS --- -->
    <section class="py-5 bg-light-subtle border-top border-bottom border-light-subtle" id="simulador">
        <div class="container py-4">
            <div class="row align-items-center mb-4">
                <div class="col-md-8">
                    <span class="text-success fw-bold"><i class="fa-solid fa-laptop-code me-2"></i>Entorno de Simulación</span>
                    <h2 class="fw-bold mt-2">Simulador de Stock de Insumos en Tiempo Real</h2>
                    <p class="text-muted mb-0">
                        Pruebe cómo el sistema descuenta stock de forma síncrona en cada venta y activa las alertas de inventario.
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="d-inline-flex align-items-center gap-2 p-2 bg-success bg-opacity-10 rounded border border-success border-opacity-25 text-success">
                        <i class="fa-solid fa-circle-exclamation alert-pulse"></i>
                        <span class="fs-7 fw-semibold">Regla RN01 activa</span>
                    </div>
                </div>
            </div>

            <!-- Panel de Controles y Tabla -->
            <div class="glass-card p-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-7 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input type="text" class="form-control form-control-custom border-start-0 ps-0" placeholder="Buscar insumo por nombre o SKU..." id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent text-muted"><i class="fa-solid fa-filter"></i></span>
                            <select class="form-select form-control-custom" id="categoryFilter" aria-label="Filtrar por Categoría">
                                <option value="Todos">Todas las Categorías</option>
                                <option value="Fertilizantes">Fertilizantes</option>
                                <option value="Herbicidas">Herbicidas</option>
                                <option value="Fungicidas">Fungicidas</option>
                                <option value="Insecticidas">Insecticidas</option>
                                <option value="Semillas">Semillas</option>
                                <option value="Herramientas">Herramientas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Productos Responsiva -->
                <div class="table-responsive">
                    <table class="table table-hover table-custom align-middle mb-0" id="productsTable">
                        <thead>
                            <tr>
                                <th style="width: 12%;">SKU / Código</th>
                                <th style="width: 28%;">Nombre del Insumo</th>
                                <th class="d-none d-md-table-cell" style="width: 15%;">Categoría</th>
                                <th class="text-center" style="width: 15%;">Stock Actual</th>
                                <th style="width: 10%;">P. Venta</th>
                                <th style="width: 12%;">Estado Stock</th>
                                <th class="text-end" style="width: 13%;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="productsTableBody">
                            <!-- Inyectado por Javascript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- --- CALCULADORA DE UTILIDAD Y MARGEN --- -->
    <section class="py-5" id="calculadora">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="text-success fw-bold"><i class="fa-solid fa-calculator me-2"></i>Herramienta de Negocio</span>
                    <h2 class="fw-bold mt-2 mb-3">Calculadora de Margen de Utilidad Agrícola</h2>
                    <p class="text-muted mb-4">
                        Según el requerimiento **RF15** del sistema, el margen de ganancia se calcula mediante la relación matemática entre el costo de adquisición y el precio de venta final de cada insumo. Simule y evalúe la viabilidad de sus precios a continuación:
                    </p>
                    
                    <div class="p-4 bg-light rounded-4 border border-light-subtle">
                        <h4 class="h6 text-uppercase fw-bold text-muted mb-4">Ecuaciones Financieras Aplicadas:</h4>
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <span class="badge bg-success py-2">Utilidad Neta</span>
                            <p class="mb-0 fs-7 text-secondary">
                                <strong>Utilidad = Precio Venta − Costo Adquisición</strong><br>
                                Ganancia neta líquida por cada unidad comercializada.
                            </p>
                        </div>
                        <div class="d-flex align-items-start gap-3">
                            <span class="badge bg-success py-2">Margen Comercial</span>
                            <p class="mb-0 fs-7 text-secondary">
                                <strong>Margen % = (Utilidad / Precio Venta) × 100</strong><br>
                                Porcentaje de ganancia sobre el precio final de venta.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="glass-card">
                        <h3 class="h5 fw-bold mb-4"><i class="fa-solid fa-sliders text-success me-2"></i>Simulador Financiero</h3>
                        
                        <!-- Costo de Compra Slider -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="rangePurchase" class="form-label mb-0 fw-medium">Costo de Adquisición (Compra):</label>
                                <span class="range-slider-value" id="labelPurchase">$35.00</span>
                            </div>
                            <input type="range" class="form-range" min="1" max="500" step="0.5" value="35" id="rangePurchase">
                        </div>

                        <!-- Precio de Venta Slider -->
                        <div class="mb-5">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="rangeSale" class="form-label mb-0 fw-medium">Precio de Venta Sugerido (POS):</label>
                                <span class="range-slider-value" id="labelSale">$55.00</span>
                            </div>
                            <input type="range" class="form-range" min="1" max="500" step="0.5" value="55" id="rangeSale">
                        </div>

                        <!-- Panel de Resultados -->
                        <div class="p-4 bg-success bg-opacity-10 rounded-4 border border-success border-opacity-20">
                            <div class="row text-center">
                                <div class="col-6 border-end border-success border-opacity-20">
                                    <small class="text-muted d-block mb-1">Utilidad Neta por Unidad</small>
                                    <div class="h3 fw-bold text-success" id="calcProfit">$20.00</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block mb-1">Margen Comercial Neto</small>
                                    <div class="h3 fw-bold text-success" id="calcMargin">36.4%</div>
                                </div>
                            </div>
                            <div class="text-center mt-3 pt-3 border-top border-success border-opacity-20">
                                <span class="badge bg-success" id="calcIndicator">Excelente Margen</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- --- SECCIÓN DE CONTACTO --- -->
    <section class="py-5 bg-light-subtle" id="contacto">
        <div class="container py-4">
            <div class="row g-5">
                <div class="col-lg-5">
                    <span class="text-success fw-bold"><i class="fa-solid fa-headset me-2"></i>Soporte Técnico</span>
                    <h2 class="fw-bold mt-2 mb-3">Comuníquese con Soporte / Desarrollo</h2>
                    <p class="text-muted mb-4">
                        ¿Tiene alguna pregunta sobre la lógica de control de stock, auditorías contables o el despliegue del sistema MVC en su servidor local?
                    </p>
                    
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="flex-shrink-0 text-success"><i class="fa-solid fa-user-tie fa-lg"></i></div>
                        <div>
                            <small class="text-muted d-block">Desarrollador Líder del Sistema</small>
                            <span class="fw-semibold">Rubén Darío Delgado Cruz</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="flex-shrink-0 text-success"><i class="fa-solid fa-code fa-lg"></i></div>
                        <div>
                            <small class="text-muted d-block">Tecnología Base</small>
                            <span class="fw-semibold">PHP 8.3 / MySQL 8.0 / MVC Architecture</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0 text-success"><i class="fa-solid fa-calendar-check fa-lg"></i></div>
                        <div>
                            <small class="text-muted d-block">Fecha de Versión</small>
                            <span class="fw-semibold">Junio de 2026 (Versión 1.1)</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div class="glass-card">
                        <h3 class="h5 fw-bold mb-4"><i class="fa-solid fa-paper-plane text-success me-2"></i>Enviar Consulta de Implementación</h3>
                        <form id="contactForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="contactName" class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control form-control-custom" id="contactName" placeholder="Escriba su nombre..." required>
                                </div>
                                <div class="col-md-6">
                                    <label for="contactEmail" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control form-control-custom" id="contactEmail" placeholder="nombre@correo.com" required>
                                </div>
                                <div class="col-12">
                                    <label for="contactMessage" class="form-label">Mensaje / Consulta Técnica</label>
                                    <textarea class="form-control form-control-custom" id="contactMessage" rows="4" placeholder="Describa su duda sobre el sistema o base de datos..." required></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary-custom px-4" id="btnSubmitContact">
                                        <i class="fa-solid fa-paper-plane me-2"></i>Enviar Mensaje
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- --- PIE DE PÁGINA --- -->
    <footer class="footer-custom">
        <div class="container text-center">
            <div class="mb-4">
                <a class="navbar-brand navbar-brand-logo justify-content-center" href="#" id="footerBrandLogo">
                    <i class="fa-solid fa-seedling text-success"></i>
                    <span>AgroStock</span>
                </a>
                <p class="text-muted mt-2 fs-7">
                    Sistema Profesional de Stock, Inventario y Facturación de Insumos Agrícolas.
                </p>
            </div>
            
            <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap">
                <span class="badge bg-secondary-subtle text-secondary border px-3 py-2"><i class="fa-brands fa-php me-1 text-primary"></i> PHP 8.3 (Strict Types)</span>
                <span class="badge bg-secondary-subtle text-secondary border px-3 py-2"><i class="fa-solid fa-database me-1 text-info"></i> MySQL 8.0 Engine</span>
                <span class="badge bg-secondary-subtle text-secondary border px-3 py-2"><i class="fa-brands fa-bootstrap me-1 text-purple" style="color: #563d7c;"></i> Bootstrap 5.3 Framework</span>
                <span class="badge bg-secondary-subtle text-secondary border px-3 py-2"><i class="fa-brands fa-html5 me-1 text-warning"></i> HTML5 Semantic UI</span>
            </div>
            
            <hr class="my-4 bg-secondary-subtle">
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center fs-7 text-muted">
                <p class="mb-0" id="footerCopyright">&copy; 2026 AgroStock. Todos los derechos reservados. Desarrollado por Rubén Darío Delgado Cruz.</p>
                <p class="mb-0 mt-2 mt-md-0" id="footerSrsInfo">Especificación SRS v1.1 - Cumplimiento del Control de Stock y Roles (RBAC)</p>
            </div>
        </div>
    </footer>

    <!-- --- MODAL DE LOGIN / INGRESO (RBAC) --- -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom p-4">
                    <h5 class="modal-title fw-bold" id="loginModalLabel">
                        <i class="fa-solid fa-user-lock text-success me-2"></i> Acceso Seguro al Sistema
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseLoginModal" style="filter: var(--text-primary) === '#f8fafc' ? 'invert(1)' : 'none';"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted mb-4 fs-7">
                        Para probar el sistema y el control de accesos basado en roles (RBAC) según el requerimiento **RF02**, seleccione uno de los siguientes perfiles de demostración preconfigurados:
                    </p>
                    
                    <!-- Fichas de Roles para autoselección -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="role-select-card" data-role="admin" id="roleCardAdmin" tabindex="0" role="button" aria-label="Seleccionar rol Administrador">
                                <i class="fa-solid fa-user-shield"></i>
                                <div class="fw-bold">Administrador</div>
                                <small class="text-muted d-block mt-1">Control de Costos & KPIs</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="role-select-card" data-role="seller" id="roleCardSeller" tabindex="0" role="button" aria-label="Seleccionar rol Vendedor">
                                <i class="fa-solid fa-cash-register"></i>
                                <div class="fw-bold">Vendedor</div>
                                <small class="text-muted d-block mt-1">POS & Facturación</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="role-select-card" data-role="client" id="roleCardClient" tabindex="0" role="button" aria-label="Seleccionar rol Cliente">
                                <i class="fa-solid fa-circle-user"></i>
                                <div class="fw-bold">Cliente</div>
                                <small class="text-muted d-block mt-1">Consulta Catálogo & Invol</small>
                            </div>
                        </div>
                    </div>

                    <!-- Caja dinámica de permisos de rol -->
                    <div class="p-3 mb-4 bg-light rounded-3 d-none border border-light-subtle" id="roleInfoBox">
                        <h6 class="fw-bold text-success mb-1" id="roleInfoTitle">Perfil Seleccionado</h6>
                        <p class="mb-0 fs-7 text-secondary" id="roleInfoDesc">Resumen de permisos y accesos.</p>
                    </div>

                    <!-- Formulario de Login -->
                    <form id="modalLoginForm">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Correo Electrónico de Acceso</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-muted"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control form-control-custom" id="loginEmail" placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="loginPassword" class="form-label">Contraseña de Seguridad</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-muted"><i class="fa-solid fa-key"></i></span>
                                <input type="password" class="form-control form-control-custom" id="loginPassword" placeholder="Contraseña cifrada..." required>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="rememberMeCheck">
                                <label class="form-check-label text-muted fs-7" for="rememberMeCheck">
                                    Recordar sesión (20 min de inactividad)
                                </label>
                            </div>
                            <a href="#" class="fs-7 text-success text-decoration-none">¿Olvidó su contraseña?</a>
                        </div>
                        
                        <button type="submit" class="btn btn-primary-custom w-100 py-2.5" id="btnLoginSubmit">
                            <i class="fa-solid fa-shield-halved me-2"></i> Iniciar Sesión de Demostración
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Custom JS Scripts -->
    <script src="js/main.js"></script>
</body>
</html>