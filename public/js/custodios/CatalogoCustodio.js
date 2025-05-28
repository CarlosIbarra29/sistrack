"use strict";
var Tabla = function() {

    $.fn.dataTable.Api.register('column().title()', function() {
        return $(this.header()).text().trim();
    });

    var initTable1 = function() {
        // begin first table
        var table = $('#kdatatable_usuarios').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
                    <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html

            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,

            order: [[ 0, "desc" ]], //ordenamiento default
            language: {
                'lengthMenu': 'Display _MENU_',
                "url": $('#datatable_i18n').val()
            },

            processing: true,
            serverSide: true,
            ajax: {
                url:$('#custodiosdatatable').val(),
                type:"POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    columnsDef: [
                        'id', 'nombre_custodio', 'curp', 'rfc','numero_telefono', 'correo_electronico', 'op_vehiculo', 'op_arma', 'permisos' ,'acciones'],
                },

            },
            columns: [
                { data: 'id' },
                { data: 'nombre_custodio' },
                { data: 'curp' },
                { data: 'rfc' },
                { data: 'numero_telefono' },
                { data: 'correo_electronico' },
                {data: 'acciones', responsivePriority: -1},
            ],

            columnDefs: [
                {
                    // const array = [full.permisos];
                    width: '110px',
                    targets: -1,
                    title: 'Acciones',
                    orderable: false,
                    render: function(data, type, full, meta) {
                          var opt_ver = ``; var opt_edit = ``; var opt_vehiculo = ``; var opt_arma=``; var opt_arma=``; var opt_desactivar=``;

                           opt_ver =  `
                                <a href="/custodio/ver-custodio/`+full.id+`" class="btn btn-sm btn-outline-success btn-icon mt-2" title="Ver custodio" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="flaticon-eye"></i>
                                    </span>
                                </a>
                            `;

                           opt_edit =  `
                                <a href="/custodio/editar-custodio/`+full.id+`" class="btn btn-sm btn-outline-success btn-icon mt-2" title="Editar custodio" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="flaticon-edit"></i>
                                    </span>
                                </a>
                            `;

                            if (full.op_vehiculo == 1){
                               opt_vehiculo =  `
                                    <a href="/custodio/agregar-informacion-vehiculo/`+full.id+`" class="btn btn-sm btn-outline-success btn-icon mt-2" title="Información vehículo" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                        <span class="svg-icon svg-icon-md">
                                            <i class="flaticon-truck"></i>
                                        </span>
                                    </a>
                                `;
                            }else{
                               opt_vehiculo =  `
                                    <a href="/custodio/editar-informacion-vehiculo/`+full.id+`" class="btn btn-sm btn-outline-success btn-icon mt-2" title="Información vehículo" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                        <span class="svg-icon svg-icon-md">
                                            <i class="flaticon-truck"></i>
                                        </span>
                                    </a>
                                `;
                            }


                            if (full.op_arma == 1){
                               opt_arma =  `
                                    <a href="/custodio/agregar-informacion-arma/`+full.id+`" class="btn btn-sm btn-outline-success btn-icon mt-2" title="Información arma" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                        <span class="svg-icon svg-icon-md">
                                            <i class="flaticon-notepad"></i>
                                        </span>
                                    </a>
                                `;
                            }else{
                               opt_arma =  `
                                    <a href="/custodio/editar-informacion-arma/`+full.id+`" class="btn btn-sm btn-outline-success btn-icon mt-2" title="Información arma" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                        <span class="svg-icon svg-icon-md">
                                            <i class="flaticon-notepad"></i>
                                        </span>
                                    </a>
                                `;
                            }


                           opt_desactivar =  `
                                <button class="btn btn-clean btn-sm btn-icon btn-outline-success mt-1" onClick="deletecustodio(`+ full.nombre +`,`+full.id+`)" data-toggle="modal" data-target="#model_delete_user" data-toggle="tooltip" data-theme="dark" title="Desactivar custodio">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="flaticon-delete"></i>
                                    </span>
                                 </button>
                            `;

                         return opt_ver + opt_edit + opt_vehiculo + opt_arma + opt_desactivar;
                        
                    },
                }

            ],

            buttons: [
                {extend: "excel", className: "invisible"},
                {extend: "pdf", className: "invisible"},
                {extend: "csv", className: "invisible"},
                {extend: "print", className: "invisible"},

            ],

            "drawCallback": function(settings, json) {
                KTApp.initTooltips();
            }


        }).on( 'init.dt', function () {
        });

        $('#export-excel').on('click', function () {
            table.button(0).trigger();
        });
        $('#export-pdf').on('click', function () {
            table.button(1).trigger();
        });
        $('#export-csv').on('click', function () {
            table.button(2).trigger();
        });
        $('#export-print').on('click', function () {
            table.button(3).trigger();
        });

        var filter = function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
        };

        $('#kt_search').on('click', function(e) {
            e.preventDefault();
            var params = {};
            $('.datatable-input').each(function() {
                var i = $(this).data('col-index');
                if (params[i]) {
                    params[i] += '|' + $(this).val();
                }
                else {
                    params[i] = $(this).val();
                }
            });
            $.each(params, function(i, val) {
                table.column(i).search(val ? val : '', false, false);
            });
            table.table().draw();
        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            $('.datatable-input').each(function() {
                $(this).val('');
                table.column($(this).data('col-index')).search('', false, false);
            });
            table.table().draw();
        });

    };

    return {

        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };

}();

jQuery(document).ready(function() {
    Tabla.init();
});


    function deletecustodio(nombre, id) {
        Swal.fire({
            title: "Estas seguro de desactivar el registro "+nombre,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Desactivarlo!",
            cancelButtonText: "No, Cancelar!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                document.getElementById("id_custodio_delete").value = id;
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Espere un momento, la información esta siendo procesada",
                    showConfirmButton: false
                });
                document.getElementById("custodio_delete_form").submit();
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelada",
                    "La acción fue cancelada",
                    "error"
                )
            }
        });

    }

    $("#kdatatable_custodios_inactivos").DataTable({
        language: {
            'lengthMenu': 'Display _MENU_',
            "url": $('#datatable_i18n').val()
        },

        "dom":
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

    $(".activar-custodio").click(function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');

        Swal.fire({
            title: "Estas seguro de activar el registro "+nombre,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Activarlo!",
            cancelButtonText: "No, Cancelar!",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                document.getElementById("id_delete").value = id;
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Espere un momento, la información esta siendo procesada",
                    showConfirmButton: false
                });
                document.getElementById("custodio_act_form").submit();
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelada",
                    "La acción fue cancelada",
                    "error"
                )
            }
        });
    });
