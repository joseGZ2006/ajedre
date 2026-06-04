(function(){
    var dtCssHref = '../assets/js/datatables/datatables.min.css';
    var dtScriptSrc = '../assets/js/datatables/datatables.min.js';
    var selector = 'table.alumno-table';
    var loaded = false;
    var scriptLoaded = false;
    var polling = null;

    function addCss() {
        if (document.querySelector('link[href="' + dtCssHref + '"]')) return;
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = dtCssHref;
        document.head.appendChild(link);
    }

    function initTables() {
        if (!window.jQuery || !window.jQuery.fn || !window.jQuery.fn.DataTable) return;
        var $ = window.jQuery;
        var tables = $(selector).not('.dt-initialized');
        if (!tables.length) return;

        tables.each(function() {
            var $table = $(this);
            if ($table.hasClass('dt-initialized')) return;
            $table.addClass('dt-initialized');
            $table.DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                lengthChange: true,
                autoWidth: false,
                language: {
                    search: 'Buscar:',
                    lengthMenu: 'Mostrar _MENU_ registros',
                    info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                    infoEmpty: 'Mostrando 0 a 0 de 0 registros',
                    infoFiltered: '(filtrado de _MAX_ registros totales)',
                    zeroRecords: 'No se encontraron registros',
                    emptyTable: 'No hay datos disponibles',
                    loadingRecords: 'Cargando...',
                    processing: 'Procesando...',
                    paginate: {
                        first: 'Primero',
                        last: 'Último',
                        next: 'Siguiente',
                        previous: 'Anterior'
                    }
                }
            });
        });
    }

    function loadDataTablesScript() {
        if (scriptLoaded) return;
        if (!window.jQuery) return;
        if (window.jQuery.fn && window.jQuery.fn.DataTable) {
            initTables();
            return;
        }

        scriptLoaded = true;
        var script = document.createElement('script');
        script.src = dtScriptSrc;
        script.onload = function() {
            initTables();
        };
        script.onerror = function() {
            console.warn('No se pudo cargar DataTables desde ' + dtScriptSrc);
        };
        document.head.appendChild(script);
    }

    function ensureReady() {
        if (window.jQuery) {
            loadDataTablesScript();
            return;
        }
        polling = setTimeout(ensureReady, 100);
    }

    function start() {
        addCss();
        if (window.jQuery && window.jQuery.fn && window.jQuery.fn.DataTable) {
            initTables();
            return;
        }
        ensureReady();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', start);
    } else {
        start();
    }
})();
