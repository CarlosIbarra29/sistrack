"use strict";
var Modulo = function() {

    var lista = ''; //lista de elementos
    var contadorDocumentos=0; //indice contador de elementos
    var validador; //validador del formulario

    var validacion = function() {
        //validacion de formulario
        const form = document.getElementById('submit_programacion');
        validador = FormValidation.formValidation(
            form,
            {
                locale: 'es_ES',
                localization: FormValidation.locales.es_ES,
                fields: {

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    declarative: new FormValidation.plugins.Declarative({
                        html5Input: true,
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //  eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
                        //  eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
                    })
                }
            }
        ).on('core.form.valid', function() {
            toastr.success("Guardando, Por favor Espere...");
        }).on('core.form.invalid', function() {
            toastr.warning("Por favor, Ingrese la información marcada en rojo.");
            KTUtil.scrollTop();
        });

        $("#btnGuardar").click(function(e) {

            e.preventDefault();
            
            var clienteId = $("#cliente_id").val();

            if (clienteId === "0") {

                var razonSocial = $.trim($("#nuevo_cliente_razon_social").val());
                if (razonSocial === "") {

                    toastr.warning("Ingresa la razón social del nuevo cliente.");
                    $("#nuevo_cliente_razon_social").addClass("is-invalid").focus();

                    return false;
                }

                $("#nuevo_cliente_razon_social").removeClass("is-invalid");
            }

            // normal
            validador.validate().then(function(status) {

                if (status === "Valid") {

                    var btnGuardar =document.getElementById("btnGuardar");
                    KTUtil.btnWait(btnGuardar,"spinner spinner-right spinner-white pr-15","Espere...",true);
                    form.submit();
                }
            });
        });
    };

    var initEvents = function() {

        // SELECT CLIENTE BUSCABLE
        $("#cliente_id").select2({
            placeholder: "Buscar y seleccionar cliente...",
            allowClear: true,
            width: "100%",
            language: {
                noResults: function() {
                    return "No se encontraron clientes";
                },
                searching: function() {
                    return "Buscando...";
                }
            }
        });


        // SELECT CUSTODIO BUSCABLE


        $("#custodio_id").select2({
            placeholder: "Buscar y asignar custodio...",
            allowClear: true,
            width: "100%",
            language: {
                noResults: function() {
                    return "No se encontraron custodios";
                },
                searching: function() {
                    return "Buscando...";
                }
            }
        });

        var arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }

        // $("#id_municipio").select2({
        //     placeholder: "Seleccione una opción",
        //     allowClear: true
        // });

        $("#id_estado").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });

        lista = construyeElementosLista();
        //botón agregar otro archivo
        $( ".hrefAgregarOtro" ).on( "click", function(event) {
            event.preventDefault();
            addArchivo();
        });
        delArchivo();

    };

    //construye  elementos de la lista
    var construyeElementosLista = function () {
        var tipoArchivo = $("#tipoArchivo").val();
        var colTipoArchivo = JSON.parse(tipoArchivo);
        var opcion ="";

        $.each(colTipoArchivo, function(i, item) {
            opcion += "<option value='"+i+"' >"+item+"</option>";
        });

        return opcion;
    };

    //validador de elementos agregados para archivo
    const archivoValidador = {
        validators: {
            notEmpty: {
                message: 'Por favor introduce un valor',
            },
            file: {
                extension: 'jpeg,jpg,png,pdf,docx,xls,gif,ppt,bmp',
                type: 'image/jpeg,image/png,application/pdf,application/msword,application/vnd.ms-excel,image/gif,application/vnd.ms-powerpoint,image/x-ms-bmp',
                message: 'Por favor ingrese un archivo válido, solo se permite imágenes, archivos de office y PDF',
            },
        },
    };

    //validador de elementos agregados para archivo
    const tipoArchivoValidador = {
        validators: {
            notEmpty: {
                message: 'Por favor introduce un valor',
            },
        },
    };

    //agrega el elemento archivo y lista desplegable
    var addArchivo = function () {
        contadorDocumentos++;
        var html = '';
        html += ([    "",
            "<tr id='trDocumento"+contadorDocumentos+"'>",

            "    <td>" +
            "       <div class='form-group mb-0'>" +
            "          <select class='form-control' name='id_documento["+contadorDocumentos+"]' id='id_documento"+contadorDocumentos+"' required>",
            "              <option value=''>Selecciona un opción</option>",
            lista,
            "          </select>",
            "       </div>" +
            "    </td>",
            "    <td>",
            "       <a href='#' class='btn btn-sm btn-clean btn-hover-icon-success btn-icon hrefEliminar' data-id='"+contadorDocumentos+"' data-toggle='tooltip' data-theme='dark' title='Eliminar'>",
            "           <i class='flaticon-delete'></i>",
            "       </a>",
            "    </td>",
            "</tr>",

            ""].join(""));
        $("#tblDocumentos tbody").append(html); //agrega el html creado
        //agrega validación del elemento creado
        validador.addField('id_documento[' + contadorDocumentos + ']', tipoArchivoValidador);
        KTApp.initTooltips(); //inicia tooltip del elemento creado
        KTApp.initFileInput(); //inicia el elemento archivo del elemento creado
    };

    //elimina un elemento
    var delArchivo = function () {
        jQuery(document).on("click", ".hrefEliminar" , function(e) {
            e.preventDefault();
            var idDocumento = $(this).attr("data-id"); //indice del elemento
            KTApp.hideTooltips(); //oculta tooltip
            validador.removeField('id_documento[' + idDocumento + ']');
            $('#trDocumento'+idDocumento).remove();//elimina el elemento
        });
    };

    const validarInput = {
        validators: {
            notEmpty: {
                message: 'Por favor introduce un valor',
            },
        },
    };


    $(document).on('change', 'select[id^="cliente_id"]', function () {
        var id = $(this).attr('id');
        var idGrupo = $(this).val();
        if (idGrupo === "0" || idGrupo === "" || idGrupo === null) {
            return;
        }
        var idDocumento = id.replace('cliente_id', '');
        var url = $('#url_tarifario').val();
        var data = {
            id: idGrupo,
            _token: $("[name='_token']").val()
        };
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                var html = '';
                html += (`
                    <option value=''>Selecciona un opción</option>
                    `);

                var colSubgrupo = JSON.parse(response.success);

                $.each(colSubgrupo, function (i, item) {
                    html += (`
                        <option value='${i}'>${item}</option>
                        `);
                });
                console.log(html);
                $('#id_tarifa').html(html);

                // validador.addField('id_municipio[' + idDocumento + ']', validarInput);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });



    var eventosEspeciales = function () {
        $('#elemento1').val();
    };


   // NUEVO CLIENTE
    var initNuevoCliente = function() {

        var $cliente = $("#cliente_id");
        var $contenedor = $("#contenedor_nuevo_cliente");
        var $nuevoCliente = $("#nuevo_cliente_razon_social");

        function actualizarNuevoCliente() {

            var clienteId = $cliente.val();

            if (clienteId === "0") {

                $contenedor.stop(true, true).slideDown(180);
                $nuevoCliente.attr("required", true);

            } else {

                $contenedor.stop(true, true).slideUp(180);
                $nuevoCliente.removeAttr("required").val("");
            }
        }

        $cliente.on("change", function() {
            actualizarNuevoCliente();
        });

        actualizarNuevoCliente();
    };

   // SIN CUSTODIO

    var initSinCustodio = function() {

        var ID_SIN_CUSTODIO = "153";

        var $custodio = $("#custodio_id");
        var $radioSi = $("#op_c_uno");
        var $radioNo = $("#op_c_dos");
        var $contenedorAcompanantes = $("#div_custodios");

        function actualizarEstadoCustodio() {

            var custodioId = $custodio.val();

            if (custodioId === ID_SIN_CUSTODIO) {

                $radioNo.prop("checked", true);
                $radioSi.prop("disabled", true);

                $contenedorAcompanantes
                    .stop(true, true)
                    .slideUp(180);

                $("#tbodyDocumentos").empty();

            } else {

                $radioSi.prop("disabled", false);

            }
        }

        $custodio.on("change", function() {
            actualizarEstadoCustodio();
        });

        actualizarEstadoCustodio();
    };

    return {

        //main function to initiate the module
        init: function() {
            initEvents();
            validacion();
            eventosEspeciales();
            initNuevoCliente();
            initSinCustodio();
        },

    };

}();

jQuery(document).ready(function() {
    Modulo.init();
});

$("#op_c_dos").click(function () {
    $("#div_custodios").hide();
});


$("#op_c_uno").click(function () {

    if ($("#custodio_id").val() === "153") {

        $("#op_c_dos").prop("checked", true);
        $("#div_custodios").hide();

        toastr.warning("No puedes agregar acompañantes mientras la programación esté sin custodio.");

        return false;
    }

    $("#div_custodios").show();

});

