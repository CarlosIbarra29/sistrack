"use strict";

jQuery(function ($) {

    var $tabla = $("#kdatatable_usuarios2");

    if (!$tabla.length || !$.fn.DataTable) {
        return;
    }

    var inactivos = $("#cliente_act_form").length > 0;

    if ($.fn.DataTable.isDataTable($tabla[0])) {
        $tabla.DataTable().destroy();
    }

    /* ======================================================
       CONFIGURACIÓN DE TABLA Y PAGINACIÓN
       ====================================================== */

    var configuracion = {
        autoWidth: false,
        responsive: false,
        pageLength: 10,

        lengthMenu: [
            [10, 20, 50, 100, -1],
            [10, 20, 50, 100, "Todos"]
        ],

        order: [[0, "asc"]],

        dom:
            "<'clientes-table-controls'li>" +
            "<'clientes-table-body't>" +
            "<'clientes-table-footer'p>",

        language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron clientes",
            emptyTable: "No hay clientes registrados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ clientes",
            infoEmpty: "Sin registros",
            infoFiltered: "(filtrados de _MAX_ clientes)",
            paginate: {
                previous: "Anterior",
                next: "Siguiente"
            }
        },

        columnDefs: [{
            targets: inactivos ? 3 : 4,
            orderable: false,
            searchable: false
        }]
    };

    var tabla = $tabla.DataTable(configuracion);

    /* ======================================================
       FILTROS DE CLIENTES
       ====================================================== */

    var selectorTexto = inactivos
        ? "#clientes_inactivos_busqueda"
        : "#clientes_busqueda";

    var selectorGrupo = inactivos
        ? "#clientes_inactivos_grupo"
        : "#clientes_grupo";

    function regexExacto(valor) {
        return valor
            ? "^\\s*" +
                $.fn.dataTable.util.escapeRegex(valor.trim()) +
                "\\s*$"
            : "";
    }

    function aplicarFiltros() {

        var texto = $(selectorTexto).val() || "";
        var grupo = $(selectorGrupo).val() || "";

        // Coincidencias en las columnas de la tabla.
        tabla.search(texto.trim());

        // Grupo exacto.
        tabla.column(inactivos ? 2 : 3).search(
            regexExacto(grupo),
            true,
            false
        );

        tabla.draw();
    }

    $(selectorTexto).on("input", aplicarFiltros);
    $(selectorGrupo).on("change", aplicarFiltros);

    $(
        inactivos
            ? "#clientes_inactivos_filtros"
            : "#clientes_filtros"
    ).on("submit", function (e) {

        e.preventDefault();
        aplicarFiltros();
    });

    /* ======================================================
       LIMPIAR FILTROS
       ====================================================== */

    $(
        inactivos
            ? "#clientes_inactivos_limpiar"
            : "#kt_reset"
    ).on("click", function () {

        $(selectorTexto).val("");
        $(selectorGrupo).val("");

        tabla.search("");
        tabla.columns().search("");
        tabla.draw();
    });

    /* ======================================================
       CONFIRMACIONES DE ACTIVACIÓN Y DESACTIVACIÓN
       ====================================================== */

    function confirmarAccion(
        titulo,
        nombre,
        formulario,
        campo,
        id
    ) {

        Swal.fire({
            title: titulo,
            text: nombre,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, continuar",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then(function (result) {

            if (!result.isConfirmed && !result.value) {
                return;
            }

            $(campo).val(id);

            Swal.fire({
                title: "Procesando solicitud",
                text: "Por favor espera...",
                icon: "info",
                showConfirmButton: false,
                allowOutsideClick: false
            });

            var form = document.getElementById(formulario);

            if (form) {
                form.submit();
            }
        });
    }

    /* ======================================================
       DESACTIVAR CLIENTE
       ====================================================== */

    $(document).on(
        "click",
        ".clientes-desactivar",
        function () {

            confirmarAccion(
                "¿Desactivar cliente?",
                $(this).attr("data-nombre"),
                "cliente_delete_form",
                "#id_cliente_delete",
                $(this).attr("data-id")
            );
        }
    );

    /* ======================================================
       ACTIVAR CLIENTE
       ====================================================== */

    $(document).on(
        "click",
        ".activar-cliente",
        function () {

            confirmarAccion(
                "¿Activar cliente?",
                $(this).attr("data-nombre"),
                "cliente_act_form",
                "#id_delete",
                $(this).attr("data-id")
            );
        }
    );

    /* ======================================================
       EXPORTAR TODOS LOS REGISTROS FILTRADOS
       ====================================================== */

    function exportar(tipo) {

        var filas = tabla.rows({
            search: "applied",
            order: "applied"
        }).data().toArray();

        var columnas = inactivos
            ? ["Razón social", "Nombre cliente", "Grupo"]
            : ["Folio", "Razón social", "Nombre cliente", "Grupo"];

        var matriz = [columnas].concat(
            filas.map(function (fila) {

                var valores = [];

                for (var i = 0; i < columnas.length; i++) {
                    valores.push(
                        $("<div>")
                            .html(fila[i])
                            .text()
                            .replace(/\s+/g, " ")
                            .trim()
                    );
                }

                return valores;
            })
        );

        if (tipo === "print") {

            var ventana = window.open("", "_blank");

            if (!ventana) return;

            var escape = function (s) {
                return $("<div>").text(s).html();
            };

            var html =
                "<html><head><title>Clientes</title></head>" +
                "<body><h2>Clientes</h2>" +
                '<table border="1" cellspacing="0" cellpadding="6">';

            matriz.forEach(function (fila) {
                html += "<tr>" +
                    fila.map(function (celda) {
                        return "<td>" + escape(celda) + "</td>";
                    }).join("") +
                    "</tr>";
            });

            ventana.document.write(
                html + "</table></body></html>"
            );

            ventana.document.close();
            ventana.focus();
            ventana.print();

            return;
        }

        if (tipo === "excel") {

            var escapeExcel = function (v) {
                return $("<div>").text(v).html();
            };

            var tablaHtml =
                '<html><head><meta charset="UTF-8"></head>' +
                '<body><table border="1">' +
                matriz.map(function (fila) {
                    return "<tr>" +
                        fila.map(function (v) {
                            return "<td>" + escapeExcel(v) + "</td>";
                        }).join("") +
                        "</tr>";
                }).join("") +
                "</table></body></html>";

            var excelBlob = new Blob(
                ["\ufeff" + tablaHtml],
                { type: "application/vnd.ms-excel" }
            );

            var excelUrl = URL.createObjectURL(excelBlob);
            var excelLink = document.createElement("a");

            excelLink.href = excelUrl;
            excelLink.download =
                "clientes_" +
                new Date().toISOString().slice(0, 10) +
                ".xls";

            document.body.appendChild(excelLink);
            excelLink.click();
            excelLink.remove();

            URL.revokeObjectURL(excelUrl);
            return;
        }

        var csv = matriz.map(function (fila) {

            return fila.map(function (valor) {
                return '"' +
                    String(valor).replace(/"/g, '""') +
                    '"';
            }).join(",");

        }).join("\r\n");

        var blob = new Blob(
            ["\ufeff" + csv],
            { type: "text/csv;charset=utf-8;" }
        );

        var url = URL.createObjectURL(blob);
        var enlace = document.createElement("a");

        enlace.href = url;
        enlace.download =
            "clientes_" +
            new Date().toISOString().slice(0, 10) +
            ".csv";

        document.body.appendChild(enlace);
        enlace.click();
        enlace.remove();

        URL.revokeObjectURL(url);
    }

    $("#export-csv").on("click", function (e) {
        e.preventDefault();
        exportar("csv");
    });

    $("#export-print").on("click", function (e) {
        e.preventDefault();
        exportar("print");
    });

    $("#export-excel").on("click", function (e) {
        e.preventDefault();

        if (
            tabla.buttons &&
            tabla.buttons(".buttons-excel").count() > 0
        ) {
            tabla.button(".buttons-excel").trigger();
        } else {
            exportar("excel");
        }
    });

});


function deletecliente(nombre, id) {
    jQuery(
        '.clientes-desactivar[data-id="' + id + '"]'
    ).trigger("click");
}
