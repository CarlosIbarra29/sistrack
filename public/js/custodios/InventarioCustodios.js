
'use strict';

$(function () {

    /* ============================================================
       SISTRACK | INVENTARIO DE CUSTODIOS
       ============================================================ */

    const idioma = {
        emptyTable: 'No hay custodios registrados',
        zeroRecords: 'No se encontraron coincidencias',
        info: 'Mostrando _START_–_END_ de _TOTAL_ custodios',
        infoEmpty: 'Mostrando 0 custodios',
        infoFiltered: '(filtrados de _MAX_ registros)',
        lengthMenu: 'Mostrar _MENU_ registros',
        paginate: {
            previous: 'Anterior',
            next: 'Siguiente'
        }
    };

    /* ============================================================
       CONFIGURACIÓN GENERAL DE TABLAS
       ============================================================ */

    function configurarTabla(selector, opciones = {}) {

        if (!$(selector).length || !$.fn.DataTable) {
            return null;
        }

        if ($.fn.DataTable.isDataTable(selector)) {
            return $(selector).DataTable();
        }

        const $tabla = $(selector);
        const $scroll = $tabla.closest('.custodios-table-scroll');
        const $panel = $scroll.closest('.custodios-panel');

        const esInactivos =
            selector === '#kdatatable_custodios_inactivos';

        /* --------------------------------------------------------
           CONTROLES PERSONALIZADOS
           -------------------------------------------------------- */

        const $superior = $(
            '<div class="custodios-dt-top"></div>'
        );

        const $inferior = $(
            '<div class="custodios-dt-bottom"></div>'
        );

        const $contador = $(
            '<span class="custodios-dt-info" aria-live="polite"></span>'
        );

        const $paginador = $(
            '<nav class="custodios-pagination" aria-label="Paginación de custodios"></nav>'
        );

        const $selector = $(`
            <label class="custodios-page-size">
                Mostrar
                <select aria-label="Registros por página">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="-1">Todos</option>
                </select>
                registros
            </label>
        `);

        $superior.append($selector);
        $inferior.append($contador, $paginador);

        // Los controles quedan fuera del scroll de la tabla.
        $superior.insertBefore($scroll);
        $inferior.insertAfter($scroll);

        if (esInactivos) {

            const $buscar = $(`
                <input
                    type="search"
                    class="custodios-inactive-search"
                    placeholder="Buscar custodio..."
                    aria-label="Buscar custodio inactivo"
                />
            `);

            $superior.append($buscar);
        }

        const tabla = $tabla.DataTable(
            $.extend(true, {

                autoWidth: false,
                responsive: false,

                pageLength: 10,

                lengthMenu: [
                    [10, 20, 50, 100, -1],
                    [10, 20, 50, 100, 'Todos']
                ],

                order: [[0, 'asc']],

                language: idioma,

                pagingType: 'simple_numbers',

                // DataTables solamente genera la tabla.
                // Nosotros controlamos el paginador.
                dom: 't',

                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                        searchable: false
                    }
                ]

            }, opciones)
        );

        function boton( texto, pagina, activo, deshabilitado, clase = '') {

            const $boton = $(
                '<button type="button" class="custodios-page-btn"></button>'
            )
                .text(texto)
                .prop('disabled', Boolean(deshabilitado));

            if (activo) {

                $boton
                    .addClass('is-active')
                    .attr('aria-current', 'page');
            }

            if (clase) {
                $boton.addClass(clase);
            }

            if (!deshabilitado && !activo) {

                $boton.on('click', function () {
                    tabla.page(pagina).draw('page');
                });
            }

            return $boton;
        }


        function actualizarControles() {

            const info = tabla.page.info();

            const inicio = info.recordsDisplay
                ? info.start + 1
                : 0;

            const fin = info.end;
            const total = info.recordsDisplay;

            $contador.text(
                'Mostrando ' +
                inicio +
                '–' +
                fin +
                ' de ' +
                total +
                ' custodios'
            );

            $selector
                .find('select')
                .val(String(tabla.page.len()));

            $paginador.empty();

            $paginador.append(
                boton(
                    '‹',
                    'previous',
                    false,
                    info.page <= 0,
                    'is-arrow'
                )
            );

            const desde = Math.max(
                0,
                Math.min(info.page - 2, info.pages - 5)
            );

            const hasta = Math.min(
                info.pages,
                desde + 5
            );

            for (let i = desde; i < hasta; i++) {

                $paginador.append(
                    boton(
                        String(i + 1),
                        i,
                        i === info.page,
                        false
                    )
                );
            }


            $paginador.append(
                boton(
                    '›',
                    'next',
                    false,
                    info.page >= info.pages - 1,
                    'is-arrow'
                )
            );
        }

        $selector.find('select').on('change', function () {

            tabla
                .page
                .len(Number(this.value))
                .draw();
        });

        $superior
            .find('.custodios-inactive-search')
            .on('input', function () {

                tabla.search(this.value).draw();
            });


        tabla.on('draw', actualizarControles);

        actualizarControles();

        return tabla;
    }

    const tabla = configurarTabla(
        '#tabla_inventario_custodios'
    );

    configurarTabla(
        '#kdatatable_custodios_inactivos'
    );


    if (tabla) {

        $('#custodios_buscar').on('input', function () {

            tabla
                .search(this.value)
                .draw();
        });


        $('#custodios_puesto').on('change', function () {

            const valor = this.value;

            tabla
                .column(2)
                .search(
                    valor
                        ? '^' +
                          $.fn.dataTable.util.escapeRegex(valor) +
                          '$'
                        : '',
                    true,
                    false
                )
                .draw();
        });

        $('#custodios_limpiar').on('click', function () {

            $('#custodios_buscar').val('');
            $('#custodios_puesto').val('');

            tabla.search('');
            tabla.columns().search('');

            tabla.draw();
        });
    }

    function confirmarAccion(titulo, nombre, formId, id) {

        if (typeof Swal === 'undefined') {
            return;
        }

        Swal.fire({

            title: titulo,
            text: nombre,
            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Sí, continuar',
            cancelButtonText: 'Cancelar',

            reverseButtons: true

        }).then(function (resultado) {

            if (
                !resultado.isConfirmed &&
                !resultado.value
            ) {
                return;
            }

            const formulario = document.getElementById(
                formId
            );

            if (!formulario) {
                return;
            }

            $(formulario)
                .find('input[name="id"]')
                .val(id);

            formulario.submit();
        });
    }

    /* ============================================================
       DESACTIVAR CUSTODIO
       ============================================================ */

    $(document).on(
        'click',
        '.desactivar_custodio',
        function () {

            confirmarAccion(
                '¿Desactivar custodio?',
                $(this).data('nombre'),
                'custodio_delete_form',
                $(this).data('id')
            );
        }
    );

    /* ============================================================
       REACTIVAR CUSTODIO
       ============================================================ */

    $(document).on(
        'click',
        '.activar-custodio',
        function () {

            confirmarAccion(
                '¿Activar custodio?',
                $(this).data('nombre'),
                'custodio_act_form',
                $(this).data('id')
            );
        }
    );

});
