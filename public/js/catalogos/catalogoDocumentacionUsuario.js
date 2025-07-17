"use strict";

var KTDatatableDocumentacionUsuario = (function () {
    var table;
    var datatable;
    var routeURL = $("#documentocustdatatable").val();
    var i18nURL = $("#datatable_i18n").val();

    var initDatatable = function () {
        datatable = $("#kdatatable_documentoscustodio").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: routeURL,
                type: "GET"
            },
            language: {
                url: i18nURL
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-left", orderable: false, searchable: false },
                { data: "documento", name: "documento" },
                {
                    data: "acciones",
                    name: "acciones",
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                }
            ]
        });
    };

    var initSearch = function () {
        $("#kt_search").on("click", function (e) {
            e.preventDefault();
            var documento = $(".datatable-input").filter('[data-col-index="1"]').val();
            datatable.column(1).search(documento).draw();
        });

        $("#kt_reset").on("click", function (e) {
            e.preventDefault();
            $(".datatable-input").val('');
            datatable.columns().search("").draw();
        });
    };

    var initExport = function () {
        $("#export-excel").on("click", function () {
            datatable.button('.buttons-excel').trigger();
        });

        $("#export-csv").on("click", function () {
            datatable.button('.buttons-csv').trigger();
        });

        $("#export-print").on("click", function () {
            datatable.button('.buttons-print').trigger();
        });
    };

    var initButtons = function () {
        datatable.buttons().container().appendTo('#kdatatable_documentoscustodio_wrapper .col-md-6:eq(0)');
    };

    var initActions = function () {
        // Editar
        $('#kdatatable_documentoscustodio').on('click', '.btn-edit', function () {
            let id = $(this).data('id');
            let nombre = $(this).data('nombre');

            $('#id_documento').val(id);
            $('#tipo_documento').val(nombre);
            $('#model_edit_tipodocumento').modal('show');
        });

        // Eliminar
        $('#kdatatable_documentoscustodio').on('click', '.btn-delete', function () {
            let id = $(this).data('id');
            $('#id_documento_delete').val(id);
            $('#tipodocumento_delete_form').submit();
        });
    };

    return {
        init: function () {
            initDatatable();
            initSearch();
            initExport();
            initActions();
        }
    };
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
buttons: [
    {
        extend: 'excel',
        text: 'Exportar a Excel',
        className: 'buttons-excel'
    },
    {
        extend: 'csv',
        text: 'Exportar a CSV',
        className: 'buttons-csv'
    },
    {
        extend: 'print',
        text: 'Imprimir',
        className: 'buttons-print'
    }
],
dom: 'Bfrtip', // necesario para mostrar los botones

})();

// Inicialización al cargar
jQuery(document).ready(function () {
    KTDatatableDocumentacionUsuario.init();
});
