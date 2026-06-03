<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Escuela de Ajedrez | Yaracuy - San Felipe / Independencia</title>
    <!-- Estilos locales: completamente offline, sin CDN, sin Google Fonts -->
    <link rel="stylesheet" href="./vista/assets/css/bootstrap.min.css  ">
    <link rel="stylesheet" href="./vista/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="./vista/assets/css/index.css">
    <link rel="icon" type="image/jpeg" href="./vista/assets/images/logo1.png">
</head>
<body>

<div class="page-container">
    <!-- Header con botón de LOGIN -->
    <div class="header-area d-flex flex-wrap align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="chess-icon-bg">
                <span class="logo"><img src="./vista/assets/images/logo1.png" alt="logo"></span>
            </div>
            <div>
                <h3 class="mb-0 fw-bold titulo">Escuela de Ajedrez <span>Yaracuy</span></h3>
                <p class="mb-0 text-white-50 small">📍 San Felipe - Independencia</p>
            </div>
        </div>
        <div class="mt-2 mt-sm-0">
            <a href="./vista/loyaut/login.html" class="btn-login-nav">🔐 Iniciar Sesión</a>
        </div>
    </div>

    <div class="container mb-5"> 
        <div class="hero-container">
            <img src="./vista/assets/images/fit_Screenshot-2026-05-11-184829-3.jpg" alt="MN Marcos Pérez" class="hero-image">
            <div class="hero-caption">
                <h5>♜ Formación de Excelencia</h5>
                <p>Nuestra sede cuenta con el respaldo de las mejores instituciones deportivas.</p>
            </div>
        </div>
    </div>

        <!-- Info escuela + sede -->
        <div class="row" style="margin-bottom: 2rem;">
            <div class="col-lg-7">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="queen-icon">♕</span>
                            <h3 class="fw-bold mb-0">La Escuela</h3>
                        </div>
                        <p>Referente en Yaracuy (San Felipe - Independencia). Más de 10 años formando campeones y aficionados. Método progresivo: iniciación, intermedio, avanzado y adultos. Aprendizaje estratégico, concentración y respeto.</p>
                        <div class="mt-3 d-flex flex-wrap gap-2">
                            <span class="badge-schedule">🕘 Desde 2012</span>
                            <span class="badge-schedule">🏆 +80 alumnos formados</span>
                            <span class="badge-schedule">👨‍🏫 8 entrenadores</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card h-100">
                    <div class="card-body">
                        <span class="location-icon">📍</span>
                        <h5 class="fw-bold mt-2">Sede principal</h5>
                        <p>Calle Bolívar, Centro Cívico Cultural, San Felipe, Independencia, Yaracuy.</p>
                        <div class="d-flex gap-3 flex-wrap">
                            <div>📞 +58 414-5123456</div>
                            <div>✉️ ajedrez@yaracuy.com</div>
                        </div>
                        <button class="btn-outline-chess mt-3" onclick="window.open('https://maps.google.com/?q=San+Felipe+Yaracuy+Venezuela', '_blank')">🗺️ Ver ubicación</button>
                    </div>
                </div>
            </div>
        </div>

     



        <!-- Evento próximo -->
        <div class="alert-event">
            <div>📅 <strong>Próximo Torneo Relámpago:</strong> Sábado 24 de mayo, 9:00 AM - Inscripciones abiertas.</div>
        </div>
    </div>

    <!-- Footer con mismo color del header (gradiente oscuro) -->
    <footer class="footer-area">
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-col-left">
                    <p class="mb-0">© 2025 Escuela de Ajedrez Yaracuy - San Felipe / Independencia.<br>Desarrollo educativo y deportivo.</p>
                </div>
                <div class="footer-col-right">
                    <div class="social-icons">
                        <a href="#" class="social-icon">📷</a>
                        <a href="#" class="social-icon">📘</a>
                        <a href="#" class="social-icon">💬</a>
                    </div>
                    <p class="small mt-2 mb-0">✉️ escuela_ajedrez@yaracuy.gob.ve | 📞 +58 254-1234567</p>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Carrusel manual JS (offline) -->
<script>
    (function() {
        const slides = document.querySelectorAll('.carousel-slide');
        const prevBtn = document.getElementById('prevSlide');
        const nextBtn = document.getElementById('nextSlide');
        const indicatorsContainer = document.getElementById('carouselIndicators');
        let currentIndex = 0;

        function updateIndicators() {
            if (!indicatorsContainer) return;
            const dots = indicatorsContainer.querySelectorAll('.indicator-dot');
            dots.forEach((dot, idx) => {
                if (idx === currentIndex) dot.classList.add('active');
                else dot.classList.remove('active');
            });
        }

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            currentIndex = index;
            updateIndicators();
        }

        function nextSlide() {
            let newIndex = currentIndex + 1;
            if (newIndex >= slides.length) newIndex = 0;
            showSlide(newIndex);
        }

        function prevSlide() {
            let newIndex = currentIndex - 1;
            if (newIndex < 0) newIndex = slides.length - 1;
            showSlide(newIndex);
        }

        if (prevBtn) prevBtn.addEventListener('click', prevSlide);
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);

        if (indicatorsContainer && slides.length) {
            for (let i = 0; i < slides.length; i++) {
                const dot = document.createElement('div');
                dot.classList.add('indicator-dot');
                if (i === 0) dot.classList.add('active');
                dot.addEventListener('click', () => showSlide(i));
                indicatorsContainer.appendChild(dot);
            }
        }

        setInterval(() => {
            nextSlide();
        }, 5000);
    })();
</script>
</body>
</html>