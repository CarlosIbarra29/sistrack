
"use strict";

/* ==========================================================
   SISTRACK - CATÁLOGO DE USUARIOS
   ========================================================== */

jQuery(function ($) {

    var $tabla = $("#kdatatable_usuarios_dos");

    if ($tabla.length && $.fn.DataTable) {

        // Evitar inicializaciones duplicadas
        if ($.fn.DataTable.isDataTable($tabla[0])) {
            $tabla.DataTable().destroy();
        }

        var idioma = $("#datatable_i18n").val();

        var configuracion = {
            autoWidth: false,
            responsive: false,
            pageLength: 50,

            lengthMenu: [
                [10, 20, 50, 100, -1],
                [10, 20, 50, 100, "Todos"]
            ],

            order: [[0, "desc"]],

            dom:
                "<'usuarios-table-controls'li>" +
                "<'usuarios-table-body't>" +
                "<'usuarios-table-footer'p>",

            language: {
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No se encontraron usuarios",
                emptyTable: "No hay usuarios registrados",
                info: "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
                infoEmpty: "Sin registros",
                infoFiltered: "(filtrados de _MAX_ usuarios)",
                paginate: {
                    previous: "Anterior",
                    next: "Siguiente"
                }
            },

            columnDefs: [
                {
                    targets: 7,
                    orderable: false,
                    searchable: false
                }
            ]
        };

        if (idioma) {
            configuracion.language.url = idioma;
        }

        var tabla = $tabla.DataTable(configuracion);

        /* ==================================================
           BUSCADOR Y FILTROS
           ================================================== */

        function aplicarFiltros() {

            var busqueda = $("#global_search_input").val() || "";
            var rfc = $("#usuarios_rfc").val() || "";
            var rol = $("#usuarios_rol").val() || "";
            var estatus = $("#usuarios_estatus").val() || "";

            // Búsqueda general por coincidencias
            tabla.search(busqueda.trim(), false, true);

            // RFC: coincidencia parcial
            tabla.column(2).search(rfc.trim(), false, true);

            // Rol: coincidencia exacta permitiendo espacios
            var rolRegex = rol
                ? "^\\s*" + $.fn.dataTable.util.escapeRegex(rol.trim()) + "\\s*$"
                : "";

            tabla.column(5).search(
                rolRegex,
                true,
                false
            );

            // Estatus: coincidencia exacta permitiendo espacios
            var estatusRegex = estatus
                ? "^\\s*" + $.fn.dataTable.util.escapeRegex(estatus.trim()) + "\\s*$"
                : "";

            tabla.column(6).search(
                estatusRegex,
                true,
                false
            );

            tabla.draw();
        }

        $("#global_search_input, #usuarios_rfc").on(
            "input",
            aplicarFiltros
        );

        $("#usuarios_rol, #usuarios_estatus").on(
            "change",
            aplicarFiltros
        );

        $("#kt_search").on("click", aplicarFiltros);

        $("#usuarios_filtros").on("submit", function (e) {
            e.preventDefault();
            aplicarFiltros();
        });

        /* ==================================================
           LIMPIAR FILTROS
           ================================================== */

        $("#kt_reset").on("click", function () {

            var formulario = document.getElementById(
                "usuarios_filtros"
            );

            if (formulario) {
                formulario.reset();
            }

            tabla.search("");
            tabla.columns().search("");
            tabla.draw();

        });
    }

    /* ======================================================
       DESACTIVAR USUARIO
       ====================================================== */

    $(document).on("click", ".usuarios-desactivar", function () {

        var id = $(this).data("id");
        var nombre = $(this).data("nombre");

        $("#id_user_desc").val(id);
        $("#name_user").val(nombre);
        $("#desactivar_add").val("");

    });

    $("#send_desactivar").on("click", function () {

        var formulario = document.getElementById(
            "submit_desactivar"
        );

        if (!formulario) return;

        if (!formulario.reportValidity()) return;

        Swal.fire({
            title: "Procesando solicitud",
            text: "Por favor espera...",
            icon: "info",
            showConfirmButton: false,
            allowOutsideClick: false
        });

        formulario.submit();
    });

    /* ======================================================
       TABLA DE USUARIOS INACTIVOS
       ====================================================== */

    var $tablaInactivos = $("#kdatatable_user_inactivo");

    if ($tablaInactivos.length && $.fn.DataTable) {

        if (!$.fn.DataTable.isDataTable($tablaInactivos[0])) {

            $tablaInactivos.DataTable({
                pageLength: 50,

                lengthMenu: [
                    [10, 20, 50, 100, -1],
                    [10, 20, 50, 100, "Todos"]
                ],

                language: {
                    lengthMenu: "Mostrar _MENU_ registros",
                    zeroRecords: "No se encontraron usuarios",
                    info: "Mostrando _START_ a _END_ de _TOTAL_",
                    paginate: {
                        previous: "Anterior",
                        next: "Siguiente"
                    }
                }
            });
        }
    }

    /* ======================================================
       ACTIVAR USUARIO
       ====================================================== */

    $(document).on("click", ".activar-user", function () {

        var id = $(this).data("id");
        var nombre = $(this).data("nombre");

        Swal.fire({
            title: "¿Activar usuario?",
            text: "Se activará el usuario " + nombre,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, activar",
            cancelButtonText: "Cancelar",
            reverseButtons: true

        }).then(function (result) {

            if (!result.isConfirmed && !result.value) {
                return;
            }

            var formulario = document.getElementById(
                "user_act_form"
            );

            if (!formulario) return;

            $("#id_user_act").val(id);

            Swal.fire({
                title: "Procesando solicitud",
                text: "Por favor espera...",
                icon: "info",
                showConfirmButton: false
            });

            formulario.submit();
        });
    });

});

function deleteDocumentacion(tipo_documento, id) {

    jQuery("#id_documento_eliminar").val(id);
    jQuery("#tipo_documento_nombre").val(tipo_documento);

}
