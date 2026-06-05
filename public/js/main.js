document.addEventListener('DOMContentLoaded', () => {
    // --- Estado de la Aplicación ---
    let products = [
        { id: 1, sku: 'FERT-001', name: 'Urea Granulada 46%', category: 'Fertilizantes', stock: 15, minStock: 5, pricePurchase: 32.50, priceSale: 45.00 },
        { id: 2, sku: 'HERB-002', name: 'Glifosato Concentrado 747', category: 'Herbicidas', stock: 8, minStock: 4, pricePurchase: 18.00, priceSale: 28.00 },
        { id: 3, sku: 'FUNG-003', name: 'Oxicloruro de Cobre 50WP', category: 'Fungicidas', stock: 3, minStock: 5, pricePurchase: 12.00, priceSale: 19.50 }, // Inicia en stock crítico
        { id: 4, sku: 'INSE-004', name: 'Clorpirifos Infiltrado 4EC', category: 'Insecticidas', stock: 0, minStock: 3, pricePurchase: 22.00, priceSale: 34.90 }, // Inicia sin stock
        { id: 5, sku: 'SEMI-005', name: 'Semilla Maíz Híbrido DK-7088', category: 'Semillas', stock: 25, minStock: 8, pricePurchase: 85.00, priceSale: 110.00 },
        { id: 6, sku: 'HERR-006', name: 'Tijera de Podar Bypass Profesional', category: 'Herramientas', stock: 12, minStock: 2, pricePurchase: 15.20, priceSale: 24.99 }
    ];

    let dashboardStats = {
        totalSalesCount: 142,
        totalEarnings: 4892.45,
        totalClients: 87,
        totalProviders: 18
    };

    // --- Selectores del DOM ---
    const productsTableBody = document.getElementById('productsTableBody');
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    
    // KPIs del Dashboard
    const kpiTotalSales = document.getElementById('kpiTotalSales');
    const kpiEarnings = document.getElementById('kpiEarnings');
    const kpiAlerts = document.getElementById('kpiAlerts');
    const kpiProductsCount = document.getElementById('kpiProductsCount');

    // Calculadora de Margen
    const rangePurchase = document.getElementById('rangePurchase');
    const rangeSale = document.getElementById('rangeSale');
    const labelPurchase = document.getElementById('labelPurchase');
    const labelSale = document.getElementById('labelSale');
    const calcProfit = document.getElementById('calcProfit');
    const calcMargin = document.getElementById('calcMargin');
    const calcIndicator = document.getElementById('calcIndicator');

    // Modal de Login & Roles
    const roleCards = document.querySelectorAll('.role-select-card');
    const loginEmailInput = document.getElementById('loginEmail');
    const loginPasswordInput = document.getElementById('loginPassword');
    const roleInfoBox = document.getElementById('roleInfoBox');
    const roleInfoTitle = document.getElementById('roleInfoTitle');
    const roleInfoDesc = document.getElementById('roleInfoDesc');

    // Switch de Tema
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const themeIcon = themeToggleBtn.querySelector('i');

    // --- Inicialización del Tema ---
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

    // --- Renderizar Tabla de Insumos ---
    function renderProducts() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedCategory = categoryFilter.value;

        productsTableBody.innerHTML = '';
        let matchedCount = 0;

        products.forEach(product => {
            const matchesSearch = product.name.toLowerCase().includes(query) || product.sku.toLowerCase().includes(query);
            const matchesCategory = selectedCategory === 'Todos' || product.category === selectedCategory;

            if (matchesSearch && matchesCategory) {
                matchedCount++;
                const row = document.createElement('tr');
                row.id = `product-row-${product.id}`;

                let stockBadgeClass = 'in-stock';
                let stockLabel = 'Existencia Plena';
                let rowHighlightClass = '';

                if (product.stock === 0) {
                    stockBadgeClass = 'no-stock';
                    stockLabel = 'Agotado (Crítico)';
                    rowHighlightClass = 'row-highlight-danger';
                } else if (product.stock <= product.minStock) {
                    stockBadgeClass = 'low-stock';
                    stockLabel = 'Bajo Stock Mínimo';
                    rowHighlightClass = 'row-highlight-warning';
                }

                row.className = rowHighlightClass;
                row.innerHTML = `
                    <td class="fw-bold">${product.sku}</td>
                    <td>
                        <div class="fw-semibold">${product.name}</div>
                        <small class="text-muted d-block d-md-none">${product.category}</small>
                    </td>
                    <td class="d-none d-md-table-cell"><span class="badge bg-light text-dark border">${product.category}</span></td>
                    <td class="text-center fw-bold">${product.stock} <small class="text-muted">(Min: ${product.minStock})</small></td>
                    <td>$${product.priceSale.toFixed(2)}</td>
                    <td>
                        <span class="badge-stock ${stockBadgeClass}">${stockLabel}</span>
                    </td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-primary-custom btn-simulate" data-id="${product.id}" ${product.stock === 0 ? 'disabled' : ''}>
                            <i class="fa-solid fa-cart-plus me-1"></i> Simular Venta
                        </button>
                    </td>
                `;
                productsTableBody.appendChild(row);
            }
        });

        if (matchedCount === 0) {
            productsTableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        <i class="fa-solid fa-box-open fa-2x mb-2 d-block"></i>
                        No se encontraron insumos con los filtros actuales.
                    </td>
                </tr>
            `;
        }

        updateDashboardKPIs();
    }

    // --- Actualizar Estadísticas/KPIs en Tiempo Real ---
    function updateDashboardKPIs() {
        // Contar alertas de stock mínimo (stock <= minStock)
        const lowStockCount = products.filter(p => p.stock <= p.minStock).length;

        // Formatear monedas
        kpiTotalSales.textContent = dashboardStats.totalSalesCount;
        kpiEarnings.textContent = `$${dashboardStats.totalEarnings.toLocaleString('es-CO', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
        kpiAlerts.textContent = lowStockCount;
        kpiProductsCount.textContent = products.length;

        // Añadir animación de pulso si hay alertas de stock bajo
        const alertsCard = document.getElementById('kpiAlertsCard');
        if (lowStockCount > 0) {
            alertsCard.classList.add('alert-pulse');
        } else {
            alertsCard.classList.remove('alert-pulse');
        }
    }

    // --- Simular una Venta Directa ---
    function handleSimulateSale(productId) {
        const product = products.find(p => p.id === productId);
        if (!product || product.stock <= 0) return;

        // Restar stock
        product.stock--;

        // Incrementar transacciones
        dashboardStats.totalSalesCount++;
        dashboardStats.totalEarnings += product.priceSale;

        // Efecto visual flash en la fila correspondiente
        const row = document.getElementById(`product-row-${productId}`);
        if (row) {
            row.classList.add('row-highlight-success');
            setTimeout(() => {
                row.classList.remove('row-highlight-success');
                renderProducts(); // Re-renderizar para actualizar badges y botones
            }, 600);
        } else {
            renderProducts();
        }

        // Mostrar un pequeño toast o notificación si se implementa, o simplemente actualizar la interfaz
    }

    // Event Delegation para botones de venta simulada
    productsTableBody.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-simulate');
        if (btn) {
            const productId = parseInt(btn.getAttribute('data-id'), 10);
            handleSimulateSale(productId);
        }
    });

    // Filtros de tabla
    searchInput.addEventListener('input', renderProducts);
    categoryFilter.addEventListener('change', renderProducts);

    // --- Calculadora de Margen de Utilidad ---
    function updateCalculator() {
        const purchaseVal = parseFloat(rangePurchase.value);
        const saleVal = parseFloat(rangeSale.value);

        // Asegurar que el precio de venta sea mayor o igual al de compra para evitar cálculos ilógicos en la UI
        if (saleVal < purchaseVal) {
            // Empujamos el precio de venta hacia arriba de forma fluida
            rangeSale.value = purchaseVal;
            labelSale.textContent = `$${purchaseVal.toFixed(2)}`;
            calculateMargin(purchaseVal, purchaseVal);
        } else {
            labelPurchase.textContent = `$${purchasePurchaseVal = purchaseVal.toFixed(2)}`;
            labelSale.textContent = `$${saleVal.toFixed(2)}`;
            calculateMargin(purchaseVal, saleVal);
        }
    }

    function calculateMargin(purchase, sale) {
        const profit = sale - purchase;
        const marginPercent = sale > 0 ? (profit / sale) * 100 : 0;

        calcProfit.textContent = `$${profit.toFixed(2)}`;
        calcMargin.textContent = `${marginPercent.toFixed(1)}%`;

        // Indicador visual de rentabilidad
        if (marginPercent < 15) {
            calcIndicator.className = 'badge bg-danger';
            calcIndicator.textContent = 'Margen Bajo (Crítico)';
        } else if (marginPercent >= 15 && marginPercent < 30) {
            calcIndicator.className = 'badge bg-warning text-dark';
            calcIndicator.textContent = 'Margen Aceptable';
        } else {
            calcIndicator.className = 'badge bg-success';
            calcIndicator.textContent = 'Excelente Margen';
        }
    }

    rangePurchase.addEventListener('input', updateCalculator);
    rangeSale.addEventListener('input', updateCalculator);

    // --- Modal de Login / Selección de Roles (RBAC) ---
    const roleCredentials = {
        admin: {
            email: 'admin@agrostock.com',
            password: 'AdminSecure8.3',
            title: 'Perfil Administrador',
            desc: 'Acceso total a configuraciones, logs del sistema, control de costos, reportes de rentabilidad y gestión de usuarios (CRUD).'
        },
        seller: {
            email: 'vendedor@agrostock.com',
            password: 'VentasPass2026',
            title: 'Perfil Vendedor',
            desc: 'Acceso directo al Punto de Venta (POS) en mostrador, facturación electrónica digital y consulta de existencias en tiempo real.'
        },
        client: {
            email: 'ruben.delgado@cliente.com',
            password: 'Cliente2026Pass',
            title: 'Perfil Cliente',
            desc: 'Interfaz de consulta para revisar la disponibilidad del catálogo de insumos y descargar copias de facturas históricas.'
        }
    };

    roleCards.forEach(card => {
        card.addEventListener('click', () => {
            // Remover clase activa de todos los demás
            roleCards.forEach(c => c.classList.remove('active'));
            
            // Activar actual
            card.classList.add('active');
            
            const role = card.getAttribute('data-role');
            const creds = roleCredentials[role];
            
            if (creds) {
                // Rellenar formulario con animación de fade-in o efecto de escritura
                loginEmailInput.value = creds.email;
                loginPasswordInput.value = creds.password;
                
                // Mostrar caja de información sobre el rol
                roleInfoTitle.textContent = creds.title;
                roleInfoDesc.textContent = creds.desc;
                roleInfoBox.classList.remove('d-none');
            }
        });
    });

    // Formulario de Contacto
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // Validación simulada
            const name = document.getElementById('contactName').value;
            const email = document.getElementById('contactEmail').value;
            const msg = document.getElementById('contactMessage').value;

            if (name && email && msg) {
                // Notificación visual de éxito
                alert(`¡Gracias ${name}! Tu mensaje ha sido simulado con éxito. En un entorno real, esto se guardaría en la base de datos.`);
                contactForm.reset();
            }
        });
    }

    // --- Carga Inicial ---
    renderProducts();
    updateCalculator();
});
