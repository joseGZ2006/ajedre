// dashboard.js

document.addEventListener('DOMContentLoaded', function() {
    // 1. Mostrar fecha actual
    const dateSpan = document.getElementById('currentDate');
    if (dateSpan) {
        const hoy = new Date();
        const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
        dateSpan.textContent = hoy.toLocaleDateString('es-ES', opciones);
    }

    // 2. Gráfico de Alumnos por Categoría (Dona)
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'doughnut',
        data: {
            labels: ['Principiantes', 'Intermedios', 'Avanzados', 'Élite'],
            datasets: [{
                data: [68, 42, 28, 18],
                backgroundColor: ['#7fcfe6', '#ffaa77', '#ff6e2e', '#2c3e50'],
                borderWidth: 0,
                hoverOffset: 8,
                borderRadius: 6,
                spacing: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { size: 12 }, usePointStyle: true, boxWidth: 8 }
                },
                tooltip: { callbacks: { label: (ctx) => `${ctx.label}: ${ctx.raw} alumnos` } }
            },
            cutout: '65%'
        }
    });

    // 3. Gráfico de Progreso de Clases (Línea)
    const ctxProgress = document.getElementById('progressChart').getContext('2d');
    new Chart(ctxProgress, {
        type: 'line',
        data: {
            labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4', 'Semana 5', 'Semana 6', 'Semana 7', 'Semana 8', 'Semana 9', 'Semana 10', 'Semana 11', 'Semana 12'],
            datasets: [{
                label: 'Asistencia promedio (%)',
                data: [72, 75, 78, 80, 82, 85, 84, 87, 89, 88, 91, 93],
                borderColor: '#7fcfe6',
                backgroundColor: 'rgba(127, 207, 230, 0.05)',
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: '#ffaa77',
                pointBorderColor: '#fff',
                pointHoverRadius: 7,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { legend: { position: 'top' }, tooltip: { callbacks: { label: (ctx) => `${ctx.raw}% asistencia` } } },
            scales: { y: { beginAtZero: true, max: 100, grid: { color: '#eef2f5' }, title: { display: true, text: 'Porcentaje (%)' } } }
        }
    });

    // 4. Cargar datos de últimos alumnos (simulación dinámica)
    const tbody = document.querySelector('#recentStudentsTable tbody');
    if (tbody) {
        const recentData = [
            { cedula: '30567890', nombre: 'Valentina Gómez', categoria: 'Intermedio', fecha: '2025-03-10', estado: 'Activo' },
            { cedula: '29876123', nombre: 'Mateo Rojas', categoria: 'Principiante', fecha: '2025-03-09', estado: 'Activo' },
            { cedula: '27456981', nombre: 'Camila Méndez', categoria: 'Avanzado', fecha: '2025-03-07', estado: 'Activo' },
            { cedula: '31245678', nombre: 'Lucas Fernández', categoria: 'Élite', fecha: '2025-03-05', estado: 'Activo' }
        ];
        
        tbody.innerHTML = '';
        recentData.forEach(alumno => {
            const row = document.createElement('tr');
            // Atributo data-label para responsive
            row.innerHTML = `
                <td data-label="Cédula">${alumno.cedula}</td>
                <td data-label="Nombre Completo">${alumno.nombre}</td>
                <td data-label="Categoría">${alumno.categoria}</td>
                <td data-label="Fecha Registro">${alumno.fecha}</td>
                <td data-label="Estado"><span class="status-badge"><i class="fas fa-check-circle"></i> ${alumno.estado}</span></td>
            `;
            tbody.appendChild(row);
        });
    }

    // 5. Funcionalidad del sidebar (toggle y collapse) 
    // Se integra con el sidebar.js existente pero añadimos persistencia visual.
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const closeSidebarBtn = document.getElementById('closeSidebarBtn');
    const pageContainer = document.querySelector('.page-container');

    // Función para cerrar sidebar en móvil
    function closeSidebarMobile() {
        if (window.innerWidth <= 768 && sidebar) {
            sidebar.classList.remove('mobile-open');
            if (overlay) overlay.classList.remove('active');
        }
    }

    // Abrir sidebar móvil
    function openSidebarMobile() {
        if (window.innerWidth <= 768 && sidebar) {
            sidebar.classList.add('mobile-open');
            if (overlay) overlay.classList.add('active');
        }
    }

    if (menuToggle) {
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (window.innerWidth <= 768) {
                openSidebarMobile();
            } else {
                // En desktop: toggle clase sidebar-collapsed
                pageContainer.classList.toggle('sidebar-collapsed');
            }
        });
    }

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openSidebarMobile();
        });
    }

    if (closeSidebarBtn) {
        closeSidebarBtn.addEventListener('click', closeSidebarMobile);
    }

    if (overlay) {
        overlay.addEventListener('click', closeSidebarMobile);
    }

    // 6. Menú de perfil (toggle)
    const profilePill = document.getElementById('profilePill');
    const profileMenu = document.getElementById('profileMenu');
    if (profilePill && profileMenu) {
        profilePill.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.classList.toggle('show');
        });
        document.addEventListener('click', function(e) {
            if (!profilePill.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.remove('show');
            }
        });
    }

    // 7. Redimensionar para cerrar sidebar si la pantalla cambia de móvil a escritorio
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && sidebar) {
            sidebar.classList.remove('mobile-open');
            if (overlay) overlay.classList.remove('active');
        }
        if (window.innerWidth <= 768 && pageContainer.classList.contains('sidebar-collapsed')) {
            pageContainer.classList.remove('sidebar-collapsed');
        }
    });
    
    // 8. Búsqueda simple (simulada con alerta)
    const searchBtn = document.getElementById('searchBtn');
    const searchInput = document.getElementById('searchInput');
    if (searchBtn) {
        searchBtn.addEventListener('click', function() {
            alert(`Búsqueda simulada: "${searchInput ? searchInput.value : ''}" - Funcionalidad en desarrollo.`);
        });
    }
});