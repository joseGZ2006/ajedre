// Toggle sidebar via class so transitions animate
function toggleSidebar(){
    var pc = document.querySelector('.page-container');
    if(!pc) return;
    pc.classList.toggle('sidebar-collapsed');
    // update aria on button
    var btn = document.getElementById('menuToggle');
    if(btn) btn.setAttribute('aria-expanded', pc.classList.contains('sidebar-collapsed'));
}

document.getElementById('menuToggle').addEventListener('click', function(e){ e.preventDefault(); toggleSidebar(); });

// Profile dropdown / menu (mejorado para móvil)
(function(){
    var pill = document.getElementById('profilePill');
    var menu = document.getElementById('profileMenu');
    var open = false;
    if(!pill || !menu) return;
    if(!pill.dataset.origWidth) pill.dataset.origWidth = pill.offsetWidth;
    
    function openMenu(){
        // En móvil no animamos el ancho
        if (window.innerWidth <= 768) {
            menu.classList.add('show');
            menu.setAttribute('aria-hidden','false');
            pill.setAttribute('aria-expanded','true');
            open = true;
            return;
        }
        var targetW = Math.max(menu.offsetWidth, pill.offsetWidth);
        pill.style.width = (targetW + 6) + 'px';
        pill.style.transform = 'translateX(-8px) scale(1.02)';
        pill.classList.add('expanded');
        menu.classList.add('show');
        menu.setAttribute('aria-hidden','false');
        pill.setAttribute('aria-expanded','true');
        open = true;
    }
    
    function closeMenu(){
        if (window.innerWidth <= 768) {
            menu.classList.remove('show');
            menu.setAttribute('aria-hidden','true');
            pill.setAttribute('aria-expanded','false');
            open = false;
            return;
        }
        pill.style.width = pill.dataset.origWidth + 'px';
        pill.style.transform = '';
        pill.classList.remove('expanded');
        menu.classList.remove('show');
        menu.setAttribute('aria-hidden','true');
        pill.setAttribute('aria-expanded','false');
        open = false;
    }
    
    pill.addEventListener('click', function(e){ 
        e.stopPropagation(); 
        open ? closeMenu() : openMenu(); 
    });
    
    pill.addEventListener('keydown', function(e){ 
        if(e.key === 'Escape'){ closeMenu(); } 
        if(e.key === 'Enter' || e.key === ' '){ 
            e.preventDefault(); 
            open ? closeMenu() : openMenu(); 
        } 
    });
    
    document.addEventListener('click', function(){ 
        if(open) closeMenu(); 
    });
    
    document.addEventListener('keydown', function(e){ 
        if(e.key === 'Escape' && open) closeMenu(); 
    });
})();

// Menu item navigation: read data-href and navigate on click/keyboard
(function(){
    var items = document.querySelectorAll('.menu-list .menu-item');
    if(!items) return;
    var currentPath = window.location.pathname;
    items.forEach(function(li){     
        var href = li.dataset.href;
        if (href) {
            var absoluteHref = new URL(href, window.location.href).pathname;
            if (absoluteHref === currentPath) {
                li.classList.add('active');
                li.setAttribute('aria-current', 'page');
                li.setAttribute('aria-disabled', 'true');
                li.style.pointerEvents = 'none';
                li.style.cursor = 'default';
            }
        }

        li.setAttribute('tabindex', '0');
        li.addEventListener('click', function(){ var href = li.dataset.href; if(href && href !== '#' && !li.classList.contains('active')) window.location.href = href; });
        li.addEventListener('keydown', function(e){ if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); var href = li.dataset.href; if(href && href !== '#' && !li.classList.contains('active')) window.location.href = href; } });
    });
})();

// Funcionalidad del sidebar para móvil
(function() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileSidebar);
    } else {
        initMobileSidebar();
    }
    
    function initMobileSidebar() {
        const overlay = document.getElementById('sidebarOverlay');
        const sidebar = document.querySelector('.sidebar');
        const closeBtn = document.getElementById('closeSidebarBtn');
        const menuBtn = document.getElementById('mobileMenuBtn');
        
        if (!menuBtn) return;
        
        function openSidebar() {
            if (sidebar) {
                sidebar.classList.add('mobile-open');
                if (overlay) overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }
        
        function closeSidebar() {
            if (sidebar) {
                sidebar.classList.remove('mobile-open');
                if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
        
        menuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            openSidebar();
        });
        
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeSidebar();
            });
        }
        
        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar && sidebar.classList.contains('mobile-open')) {
                closeSidebar();
            }
        });
        
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                if (sidebar && sidebar.classList.contains('mobile-open')) {
                    sidebar.classList.remove('mobile-open');
                }
                if (overlay && overlay.classList.contains('active')) {
                    overlay.classList.remove('active');
                }
                document.body.style.overflow = '';
            }
        });
    }
})();