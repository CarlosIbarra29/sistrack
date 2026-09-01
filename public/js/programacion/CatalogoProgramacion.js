"use strict";

var Tabla = function() {

    $.fn.dataTable.Api.register('column().title()', function() {
        return $(this.header()).text().trim();
    });

    var initTable1 = function() {

        var table = $('#kdatatable_programacion').DataTable({
            responsive: true,

            dom: `<'row'<'col-sm-12'tr>>
                  <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            order: [[0, "desc"]],
            language: {
                'lengthMenu': 'Display _MENU_',
                "url": $('#datatable_i18n').val()
            },
            processing: true,
            serverSide: true,

            ajax: {

                url: $('#programaciondatatable').val(),
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                data: {

                    columnsDef: [
                        'id',
                        'folio',
                        'tipo_servicio',
                        'estatus_programacion',
                        'nombre_cliente',
                        'dom_origen',
                        'dom_destino',
                        'fecha_servicio',
                        'acciones'
                    ]

                }

            },

            columns: [
                { data: 'id' },
                { data: 'folio' },
                { data: 'nombre_cliente' },
                { data: 'dom_origen' },
                { data: 'dom_destino' },
                { data: 'fecha_servicio' },
                { data: 'tipo_servicio' },
                { data: 'estatus_programacion' },
                {
                    data: 'acciones',
                    responsivePriority: -1
                }
            ],

            columnDefs: [

                {

                    width: '50px',
                    targets: -3,
                    orderable: true,

                    render: function(data, type, full) {

                        var status = {

                            0: {
                                title: 'Foraneo',
                                class: 'label-outline-danger'
                            },

                            1: {
                                title: 'Local',
                                class: 'label-outline-warning'
                            }

                        };

                        if (
                            typeof status[full.tipo_servicio] ===
                            'undefined'
                        ) {
                            return data;
                        }

                        return (
                            '<span class="label font-weight-bold ' +
                            status[full.tipo_servicio].class +
                            ' label-inline">' +
                            status[full.tipo_servicio].title +
                            '</span>'
                        );

                    }

                },

                {

                    width: '250px',
                    targets: -1,
                    orderable: false,

                    render: function(data, type, full) {

                        var opt_ver = `
                            <a href="/programacion/ver-programacion/${full.id}"
                               class="btn btn-sm btn-outline-success btn-icon mt-2" title="Ver programación"
                               data-theme="dark" data-toggle="tooltip" data-placement="top">

                                <span class="svg-icon svg-icon-md">
                                    <i class="flaticon-eye"></i>
                                </span>

                            </a>
                        `;

                        var opt_edit = `
                            <a href="/programacion/editar-programacion/${full.id}"
                               class="btn btn-sm btn-outline-success btn-icon mt-2"
                               title="Editar programación"
                               data-theme="dark"
                               data-toggle="tooltip"
                               data-placement="top">

                                <span class="svg-icon svg-icon-md">
                                    <i class="flaticon-edit"></i>
                                </span>

                            </a>
                        `;

                        var opt_desactivar = `
                            <button class="btn btn-clean btn-sm btn-icon btn-outline-success mt-1"
                                    onClick="deleteprogramacion(${full.id},${full.id})"
                                    data-toggle="modal"
                                    data-target="#model_delete_user"
                                    data-theme="dark"
                                    title="Desactivar programación">

                                <span class="svg-icon svg-icon-md">
                                    <i class="flaticon-delete"></i>
                                </span>

                            </button>
                        `;

                        return (
                            opt_ver +
                            opt_edit +
                            opt_desactivar
                        );

                    }

                }

            ],

            buttons: [

                {
                    extend: "excel",
                    className: "invisible"
                },

                {
                    extend: "pdf",
                    className: "invisible"
                },

                {
                    extend: "csv",
                    className: "invisible"
                },

                {
                    extend: "print",
                    className: "invisible"
                }

            ],

            drawCallback: function() {
                KTApp.initTooltips();
            }

        });

        $('#export-excel').on(
            'click',
            function() {
                table.button(0).trigger();
            }
        );

        $('#export-pdf').on(
            'click',
            function() {
                table.button(1).trigger();
            }
        );

        $('#export-csv').on(
            'click',
            function() {
                table.button(2).trigger();
            }
        );

        $('#export-print').on(
            'click',
            function() {
                table.button(3).trigger();
            }
        );

        $('#kt_search').on(
            'click',
            function(e) {

                e.preventDefault();
                var params = {};

                $('.datatable-input').each(
                    function() {
                        var i = $(this).data('col-index');
                        params[i] = params[i] ? params[i] + '|' + $(this).val()  : $(this).val();
                    }
                );

                $.each(
                    params,
                    function(i, val) {

                        table.column(i).search( val ? val : '', false, false );
                    }
                );

                table.table().draw();
            }
        );

        $('#kt_reset').on('click', function(e) 
            {
                e.preventDefault();
                $('.datatable-input').each(
                    function() {
                        $(this).val('');
                        table.column($(this).data('col-index')).search('',false,false);
                    }
                );

                table.table().draw();
            }
        );
    };

    return {
        init: function() {
            initTable1();
        }
    };
}();

jQuery(document).ready(
    function() {
        Tabla.init();
    }
);

function deleteprogramacion(nombre, id) {

    Swal.fire({
        title: "Estas seguro de desactivar el registro No. " + nombre,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText:"Si, Desactivarlo!",
        cancelButtonText:"No, Cancelar!",
        reverseButtons: true
    }).then(
        function(result) {

            if (result.value) {

                document.getElementById("id_programacion_delete").value = id;

                Swal.fire({

                    position:"top-center",
                    icon:"success",
                    title:"Espere un momento, la información esta siendo procesada",
                    showConfirmButton: false

                });

                document.getElementById("programacion_delete_form").submit();

            } else if (result.dismiss ==="cancel") {
                Swal.fire("Cancelada","La acción fue cancelada","error");
            }

        }
    );

}

$("#kdatatable_programacion_inactivos")
    .DataTable({

        language: {
            'lengthMenu':'Display _MENU_',
            "url":$('#datatable_i18n').val()
        },

        dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +
            "<'table-responsive'tr>" +
            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"

    });

$(".activar-custodio")
    .click(function() {});

$(".activar-programacion")
    .click(
        function() {

            var id = $(this).data('id');
            var nombre = $(this).data('nombre');

            Swal.fire({

                title:"Estas seguro de activar el registro No." +nombre,
                icon:"warning",
                showCancelButton: true,
                confirmButtonText: "Si, Activarlo!",
                cancelButtonText:"No, Cancelar!",
                reverseButtons: true

            }).then(
                function(result) {

                    if (result.value) {

                        document.getElementById("id_delete").value = id;
                        
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Espere un momento, la información esta siendo procesada",
                            showConfirmButton: false
                        });

                        document.getElementById("programacion_act_form").submit();

                    } else if (result.dismiss === "cancel") {
                        Swal.fire("Cancelada","La acción fue cancelada","error");
                    }
                }
            );
        }
    );

$("#kdatatable_programacion_activo")
    .DataTable({

        language: {
            'lengthMenu': 'Display _MENU_',
            "url": $('#datatable_i18n').val()
        },

        dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +
            "<'table-responsive'tr>" +
            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
    });

$(document).on(
    'change',
    'select[id^="monitoreo_id"]',
    function() {

        var id = $(this).attr('id');
        var programacion = $(this).data('programacion');
        var idGrupo =  $(this).val();
        var idDocumento = id.replace('id_estado', '');
        var url = $('#url_estatus').val();
        var data = {

            id: idGrupo,
            id_programacio: programacion,
            _token: $("[name='_token']").val()

        };

        console.log(
            "Id del programacion:" + programacion
        );

        $.ajax({

            url: url,
            type: 'POST',
            data: data,

            success:
                function() {

                    console.log( "Actualizado");

                    Swal.fire({
                        title:"Actualizado!",
                        text:"El campo de monitoreo se actualizo correctamente!",
                        icon:"success"
                    });

                },

            error:
                function(error) {
                    console.log(error);
                }
        });
    }
);

function addincidenciaid(id) {
    document.getElementById("id_programacion").value = id;
}

$("#send_incidencia")
    .click(
        function() {

            var observacion = document.getElementById("observacion").value;
            
            if (observacion == "") {

                Swal.fire("Para continuar debes agregar la observacion");
                return;

            }

            Swal.fire({
                position:"top-center",
                icon:"success",
                title:"Espere un momento, la información esta siendo procesada",
                showConfirmButton:false
            });

            document
                .getElementById("submit_incidencia").submit();

        }
    );

/* ==========================================================================
   SERVICIOS PROGRAMADOS
   BUSCADOR POR COINCIDENCIA + PAGINACIÓN DE 20
   ========================================================================== */

(function() {

    var registrosPorPagina = 10;
    var paginaActual = 1;
    var filasOriginales = [];
    var filasFiltradas = [];
    var tabla = document.getElementById('servicios_programados_table');
    var buscador = document.getElementById('servicios_programados_buscar'  );
    var paginador = document.getElementById('servicios_programados_paginador');
    var info = document.getElementById('servicios_programados_info');

    if (!tabla) {
        return;
    }

    var tbody = tabla.querySelector('tbody');

    if (!tbody) {
        return;
    }

    filasOriginales =  Array.prototype.slice.call( tbody.querySelectorAll('tr') );
    filasFiltradas = filasOriginales.slice();

    var filaSinResultados =  document.createElement('tr');

    var celdaSinResultados = document.createElement('td');

    celdaSinResultados.colSpan = 8;
    celdaSinResultados.className = 'programacion-no-results';
    celdaSinResultados.textContent = 'No se encontraron servicios que coincidan con la búsqueda.';
    filaSinResultados.appendChild(celdaSinResultados);
    filaSinResultados.style.display ='none';

    tbody.appendChild(filaSinResultados);

    function normalizarTexto(texto) {

        return String(texto || '')
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g,'')
            .trim();
    }

    function filtrar() {

        var termino = normalizarTexto(buscador ? buscador.value : '' );

        filasFiltradas =
            termino === ''
                ? filasOriginales.slice()
                : filasOriginales.filter(
                    function(fila) {

                        return normalizarTexto(
                            fila.textContent
                        ).indexOf(
                            termino
                        ) !== -1;

                    }
                );

        paginaActual = 1;

        renderizar();

    }

    function renderizar() {

        filasOriginales.forEach(
            function(fila) {
                fila.style.display ='none';
            }
        );

        var total =filasFiltradas.length;
        var totalPaginas =Math.max(1,Math.ceil(total /registrosPorPagina));

        if (paginaActual >totalPaginas) {
            paginaActual =totalPaginas;
        }

        var inicio = (paginaActual - 1) * registrosPorPagina;
        var fin = inicio + registrosPorPagina;
        var filasPagina = filasFiltradas.slice( inicio, fin);

        filasPagina.forEach(
            function(fila) {
                fila.style.display = '';
            }
        );

        filaSinResultados.style.display = total === 0 ? '' : 'none';

        renderizarInfo(total, inicio,filasPagina.length );
        renderizarPaginador(totalPaginas,total);

    }

    function renderizarInfo(total,inicio,cantidad) {

        if (!info) {
            return;
        }

        if (total === 0) {

            info.textContent = '0 servicios encontrados';

            return;

        }

        info.textContent = 'Mostrando ' + (inicio + 1) + ' - ' + (inicio + cantidad) + ' de ' + total + ' servicios';

    }

    function renderizarPaginador( totalPaginas, total) {

        if (!paginador) {
            return;
        }

        paginador.innerHTML = '';

        if ( total <= registrosPorPagina ) {
            return;
        }

        paginador.appendChild(

            crearBoton(
                '‹',
                paginaActual - 1,
                paginaActual === 1,
                false
            )

        );

        obtenerPaginas(totalPaginas).forEach(
            function(numeroPagina) {

                paginador.appendChild(

                    crearBoton(
                        numeroPagina,
                        numeroPagina,
                        false,
                        numeroPagina === paginaActual
                    )

                );

            }
        );

        paginador.appendChild(

            crearBoton(
                '›',
                paginaActual + 1,
                paginaActual === totalPaginas,
                false
            )

        );

    }

    function obtenerPaginas(
        totalPaginas
    ) {

        var maximo = 5;
        var inicio = Math.max(1,paginaActual - 2);
        var fin = Math.min(totalPaginas,inicio + maximo - 1);
        if ((fin - inicio + 1) < maximo ) {

            inicio = Math.max(1, fin -  maximo + 1);

        }

        var paginas = [];

        for ( var i = inicio; i <= fin; i++) {
            paginas.push(i);
        }

        return paginas;

    }

    function crearBoton(texto,pagina,deshabilitado,activo) {

        var boton = document.createElement('button');
        boton.type = 'button';
        boton.className = 'programacion-page-button';
        boton.textContent = texto;
        boton.disabled = deshabilitado;

        if (activo) {
            boton.classList.add( 'active' );
        }

        boton.addEventListener( 'click',
            function() {

                if ( deshabilitado) {
                    return;
                }

                paginaActual = pagina;

                renderizar();

                var panel = document.querySelector('.programacion-services-panel');

                if (panel) {

                    var top = panel.getBoundingClientRect().top + window.pageYOffset - 85;

                    window.scrollTo({
                        top: top,
                        behavior: 'smooth'
                    });

                }

            }
        );

        return boton;

    }

    if (buscador) {

        buscador.addEventListener(
            'input',
            filtrar
        );

    }

    renderizar();

})();

/* ==========================================================================
   COLAPSAR / EXPANDIR NUEVA PROGRAMACIÓN
   ========================================================================== */

$(document).ready(function() {

    var $btnToggleProgramacion = $('#btnToggleProgramacion');
    var $contenedorProgramacion = $('#programacionFormCollapse');
    var $panelProgramacion = $('.programacion-form-panel');

    if (!$btnToggleProgramacion.length || !$contenedorProgramacion.length) {
        return;
    }

    $btnToggleProgramacion.on('click', function() {

        var estaAbierto = $contenedorProgramacion.hasClass('is-open');

        if (estaAbierto) {
            cerrarFormularioProgramacion();
        } else {
            abrirFormularioProgramacion();
        }

    });


    function cerrarFormularioProgramacion() {

        $contenedorProgramacion.removeClass('is-open').addClass('is-collapsed');
        $panelProgramacion.addClass('is-collapsed');
        $btnToggleProgramacion.removeClass('is-open').attr('aria-expanded', 'false');
        $btnToggleProgramacion.find('.programacion-collapse-btn__text').text('Nuevo servicio');

    }

    function abrirFormularioProgramacion() {

        $contenedorProgramacion.removeClass('is-collapsed').addClass('is-open');
        $panelProgramacion.removeClass('is-collapsed');
        $btnToggleProgramacion.addClass('is-open').attr('aria-expanded', 'true');
        $btnToggleProgramacion.find('.programacion-collapse-btn__text').text('Cerrar');

    }

});