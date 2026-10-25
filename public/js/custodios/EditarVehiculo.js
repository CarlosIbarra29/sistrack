"use strict";
var Modulo = function() {

    var lista = ''; //lista de elementos
    var contadorDocumentos=0; //indice contador de elementos
    var contadorFotografia = 0;
    var validador; //validador del formulario

    var validacion = function() {
        //validacion de formulario
        const form = document.getElementById('submit_vehiculo');
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

        $( "#btnGuardar" ).click(function( e ) {
            e.preventDefault();
            var fechaFaltante = false;

            $("#tblDocumentos tbody tr").each(function () {
                var $select = $(this).find("select[name^='id_documento[']");
                var $fecha = $(this).find("input[name^='vigencia[']");

                if (!$select.length || !$fecha.length) {
                    return;
                }

                var requiereVigencia =
                    $select.find("option:selected").attr("data-vigencia") === "1";

                if (requiereVigencia && !$fecha.val()) {
                    fechaFaltante = true;
                    $fecha.addClass("is-invalid");
                } else {
                    $fecha.removeClass("is-invalid");
                }
            });

            if (fechaFaltante) {
                toastr.warning("Selecciona la fecha de vigencia de los documentos que la requieren.");

                $('a[href="#kt_tab_pane_4"]').tab("show");
                return;
            }
            validador.validate().then(function(status) {
                if (status === 'Valid'){
                    var btnGuardar = document.getElementById('btnGuardar');
                    KTUtil.btnWait( btnGuardar, 'spinner spinner-right spinner-white pr-15', 'Espere...', true);
                    form.submit();
                }
            });
        });
    };

    var initEvents = function() {

        var arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }

        lista = construyeElementosLista();
        iniciarVigenciaDocumentos();
        //botón agregar otro archivo
        $( ".hrefAgregarOtro" ).on( "click", function(event) {
            event.preventDefault();
            addArchivo();
        });
        delArchivo();

        $( ".hrefAgregarOtroF" ).on( "click", function(event) {
            event.preventDefault();
            addArchivoF();
        });
        delArchivoF();


    };

    var initSwalEliminarDdocumento = function() {
        $(".hrefEliminarDocumento").click(function(e) {

            e.preventDefault();
            var id = $(this).attr('data-id');
            var documento = $(this).attr('data-documento');
            var block = $('#submit_contrato_edit');

            Swal.fire({
                title: "¿Desea eliminar el documento?.",
                text: documento,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Eliminar Documento",
                cancelButtonText: "Cerrar",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: $('#documentoEliminarPath').val(),
                        data: {
                            id: id,
                            _token: $("[name='_token']").val()
                        },
                        beforeSend: function() {
                            KTApp.block(block, {
                                state: 'primary',
                                message: 'Espere por favor...'
                            });
                        }
                    }).done(function(data) {
                        KTApp.unblock(block);
                        if (data.estatus){
                            $('#trDocumento'+id).remove();//elimina el elemento html
                            toastr.options =
                                {
                                    "closeButton" : true,
                                    "progressBar" : true
                                }
                            toastr.success("El documento se elimino correctamente.");

                        }else{
                            toastr.options =
                                {
                                    "closeButton" : true,
                                    "progressBar" : true
                                }
                            toastr.error("No es posible eliminar el documento, por favor intente más tarde.");
                        }
                    });
                }
            });
        });
    };


    var initSwalEliminarFotografia = function() {
        $(".hrefEliminarFotografia").click(function(e) {

            e.preventDefault();
            var id = $(this).attr('data-id');
            var documento = $(this).attr('data-documento');
            var block = $('#submit_contrato_edit');

            Swal.fire({
                title: "¿Desea eliminar la fotografía?.",
                text: documento,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Eliminar Fotografía",
                cancelButtonText: "Cerrar",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: $('#fotografiaEliminarPath').val(),
                        data: {
                            id: id,
                            _token: $("[name='_token']").val()
                        },
                        beforeSend: function() {
                            KTApp.block(block, {
                                state: 'primary',
                                message: 'Espere por favor...'
                            });
                        }
                    }).done(function(data) {
                        KTApp.unblock(block);
                        if (data.estatus){
                            $('#trFotografia'+id).remove();//elimina el elemento html
                            $('#cuGalleryPhoto'+id).remove();
                            toastr.options =
                                {
                                    "closeButton" : true,
                                    "progressBar" : true
                                }
                            toastr.success("La fotografía se elimino correctamente.");

                        }else{
                            toastr.options =
                                {
                                    "closeButton" : true,
                                    "progressBar" : true
                                }
                            toastr.error("No es posible eliminar la fotografía, por favor intente más tarde.");
                        }
                    });
                }
            });
        });
    };


    //construye  elementos de la lista
    var construyeElementosLista = function () {
        var tipoArchivo = $("#tipoArchivo").val();
        var colTipoArchivo = JSON.parse(tipoArchivo);
        var opcion = "";

        $.each(colTipoArchivo, function (id, item) {
            opcion += $("<option>", {
                value: id,
                text: item.nombre
            })
            .attr("data-vigencia", Number(item.vigencia) === 1 ? "1" : "0")
            .prop("outerHTML");
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
                extension: 'jpeg,jpg,png,pdf,doc,xls,gif,ppt,bmp',
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

    var actualizarVigenciaDocumento = function (select) {
        var $select = $(select);
        var $fila = $select.closest("tr");
        var $opcion = $select.find("option:selected");
        var requiereVigencia = $opcion.attr("data-vigencia") === "1";

        var $fecha = $fila.find("input[name^='vigencia[']");
        var $contenedor = $fecha.closest("td");

        if (requiereVigencia) {
            $contenedor.removeClass("cu-vigencia-oculta");
            $fecha.prop("disabled", false);
            $fecha.prop("required", true);
        } else {
            $fecha.val("");
            $fecha.prop("required", false);
            $fecha.prop("disabled", true);
            $contenedor.addClass("cu-vigencia-oculta");
        }
    };

    var iniciarVigenciaDocumentos = function () {
        $(document).on(
            "change",
            "#tblDocumentos select[name^='id_documento[']",
            function () {
                actualizarVigenciaDocumento(this);
            }
        );
    };

    //agrega el elemento archivo y lista desplegable
    var addArchivo = function () {
        contadorDocumentos++;
        var html = '';
        html += ([    "",
            "<tr id='trDocumento"+contadorDocumentos+"'>",
            "    <td>",
            "        <div class='form-group mb-0'>",
            "           <div class='custom-file'>",
            "               <input type='file' class='custom-file-input' id='archivo"+contadorDocumentos+"' name='archivo["+contadorDocumentos+"]' required />",
            "               <label class='custom-file-label' for='archivo"+contadorDocumentos+"'>Selecciona un archivo</label>",
            "           </div>",
            "        </div>",
            "    </td>",
            "    <td>" +
            "       <div class='form-group mb-0'>" +
            "          <select class='form-control' name='id_documento["+contadorDocumentos+"]' id='id_documento"+contadorDocumentos+"' required>",
            "              <option value=''>Selecciona un opción</option>",
            lista,
            "          </select>",
            "       </div>" +
            "    </td>",
            "    <td>" +
            "       <div class='form-group mb-0'>" +
            "           <input type='date' class='form-control' name='vigencia["+contadorDocumentos+"]' id='vigencia"+contadorDocumentos+"' >",
            "       </div>" +
            "    </td>",
            "    <td>",
            "       <a href='#' class='btn btn-clean btn-icon btn-outline-success mt-1 hrefEliminar' data-id='"+contadorDocumentos+"' data-toggle='tooltip' data-theme='dark' title='Eliminar'>",
            "           <i class='flaticon-delete'></i>",
            "       </a>",
            "    </td>",
            "</tr>",

            ""].join(""));
        $("#tblDocumentos tbody").append(html); //agrega el html creado
        //agrega validación del elemento creado
        validador.addField('archivo[' + contadorDocumentos + ']', archivoValidador);
        validador.addField('id_documento[' + contadorDocumentos + ']', tipoArchivoValidador);
        KTApp.initTooltips(); //inicia tooltip del elemento creado
        KTApp.initFileInput(); //inicia el elemento archivo del elemento creado
        actualizarVigenciaDocumento(document.getElementById("id_documento" + contadorDocumentos))
    };

    //elimina un elemento
    var delArchivo = function () {
        jQuery(document).on("click", ".hrefEliminar" , function(e) {
            e.preventDefault();
            var idDocumento = $(this).attr("data-id"); //indice del elemento
            KTApp.hideTooltips(); //oculta tooltip
            //elimina la validación del elemento
            validador.removeField('archivo[' + idDocumento + ']');
            validador.removeField('id_documento[' + idDocumento + ']');
            $('#trDocumento'+idDocumento).remove();//elimina el elemento
        });
    };


    //agrega el elemento archivo y lista desplegable
    var addArchivoF = function () {
        contadorFotografia++;
        var html = '';
        html += ([    "",
            "<tr id='trDocumentoF"+contadorFotografia+"'>",
            "    <td>",
            "        <div class='form-group mb-0'>",
            "           <div class='custom-file'>",
            "               <input type='file' class='custom-file-input' id='foto"+contadorFotografia+"' name='foto["+contadorFotografia+"]' required />",
            "               <label class='custom-file-label' for='foto"+contadorFotografia+"'>Selecciona un archivo</label>",
            "           </div>",
            "        </div>",
            "    </td>",
            "    <td>",
            "       <a href='#' class='btn btn-clean btn-icon btn-outline-success mt-1 hrefEliminarF' data-id='"+contadorFotografia+"' data-toggle='tooltip' data-theme='dark' title='Eliminar'>",
            "           <i class='flaticon-delete'></i>",
            "       </a>",
            "    </td>",
            "</tr>",

            ""].join(""));
        $("#tblDocumentosF tbody").append(html); //agrega el html creado
        //agrega validación del elemento creado
        validador.addField('foto[' + contadorFotografia + ']', archivoValidador);
        validador.addField('id_foto[' + contadorFotografia + ']', tipoArchivoValidador);
        KTApp.initTooltips(); //inicia tooltip del elemento creado
        KTApp.initFileInput(); //inicia el elemento archivo del elemento creado
    };

    //elimina un elemento
    var delArchivoF = function () {
        jQuery(document).on("click", ".hrefEliminarF" , function(e) {
            e.preventDefault();
            var idDocumento = $(this).attr("data-id"); //indice del elemento
            KTApp.hideTooltips(); //oculta tooltip
            //elimina la validación del elemento
            validador.removeField('foto[' + idDocumento + ']');
            validador.removeField('id_foto[' + idDocumento + ']');
            $('#trDocumentoF'+idDocumento).remove();//elimina el elemento
        });
    };

    var iniciarGaleriaFotografias = function () {

        $(document).on("click", ".cu-gallery-preview", function (e) {
            e.preventDefault();

            var url = $(this).attr("data-preview-url");
            var titulo = $(this).attr("data-preview-title");

            $("#cuGaleriaModalImagen").attr("src", url);
            $("#cuGaleriaModalTitulo").text(titulo || "Vista previa");

            $("#cuGaleriaModal").modal("show");
        });

        $("#cuGaleriaModal").on("hidden.bs.modal", function () {
            $("#cuGaleriaModalImagen").attr("src", "");
        });

    };

    var eventosEspeciales = function () {
        $('#elemento1').val();
    };

    return {

        //main function to initiate the module
        init: function() {
            initEvents();
            validacion();
            eventosEspeciales();
            initSwalEliminarDdocumento();
            initSwalEliminarFotografia();
             iniciarGaleriaFotografias();
        },

    };

}();

jQuery(document).ready(function() {
    Modulo.init();
});