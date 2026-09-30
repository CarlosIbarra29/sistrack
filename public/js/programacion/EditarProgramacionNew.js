"use strict";

var Modulo = function() {

    var lista = '';
    var contadorDocumentos = 0;
    var validador;

    var validacion = function() {

        const form = document.getElementById('submit_programacion');
        validador = FormValidation.formValidation(form, {

            locale: 'es_ES',
            localization: FormValidation.locales.es_ES,
            fields: {},
            plugins: {

                trigger: new FormValidation.plugins.Trigger(),
                submitButton: new FormValidation.plugins.SubmitButton(),
                declarative: new FormValidation.plugins.Declarative({
                    html5Input: true
                }),
                bootstrap: new FormValidation.plugins.Bootstrap({})

            }

        }).on('core.form.valid', function() {

            toastr.success("Guardando, Por favor Espere...");

        }).on('core.form.invalid', function() {

            toastr.warning("Por favor, Ingrese la información marcada en rojo.");
            KTUtil.scrollTop();

        });

        $("#btnGuardar").on("click", function(e) {

            e.preventDefault();

            if ($("#custodio_id").val() === "154" && $.trim($("#custodio_emergente").val()) === "") {

                toastr.warning("Ingresa el nombre del custodio emergente.");
                $("#custodio_emergente").addClass("is-invalid").focus();
                return false;
            }

            $("#custodio_emergente").removeClass("is-invalid");

            validador.validate().then(function(status) {

                if (status === 'Valid') {

                    var btnGuardar = document.getElementById('btnGuardar');

                    KTUtil.btnWait(btnGuardar,'spinner spinner-right spinner-white pr-15','Espere...',true);
                    form.submit();
                }

            });

        });

    };

    var initEvents = function() {

        $("#cliente_id").select2({

            placeholder: "Buscar y seleccionar cliente...",
            allowClear: false,
            width: "100%",
            language: {
                noResults: function() {return "No se encontraron clientes";},
                searching: function() {return "Buscando...";}
            }

        });

        $("#custodio_id").select2({

            placeholder: "Buscar y asignar custodio...",
            allowClear: false,
            width: "100%",
            language: {

                noResults: function() {return "No se encontraron custodios";},
                searching: function() {return "Buscando...";}

            }

        });

        lista = construyeElementosLista();

        $(document).on(
            "click",
            ".hrefAgregarOtro",
            function(event) {

                event.preventDefault();
                addAcompanante();

            }
        );

        delAcompananteNuevo();
        initSwalEliminarAcompananteExistente();

    };

    var construyeElementosLista = function() {

        var tipoArchivo = $("#tipoArchivo").val();
        var colCustodios = tipoArchivo ? JSON.parse(tipoArchivo) : {};
        var opcion = "";

        $.each(colCustodios,
            function(i, item) {

                if (String(i) !== "153") {

                    opcion +="<option value='" + i + "'>" + item + "</option>";

                }

            }
        );

        return opcion;

    };

    const acompananteValidador = {

        validators: {

            notEmpty: {
                message:'Selecciona un custodio acompañante'
            }

        }

    };

    var addAcompanante = function() {

        contadorDocumentos++;
        var html = "";
        html += "<tr id='trDocumentoNuevo" + contadorDocumentos + "'>";
        html += "<td>";
        html += "<div class='programacion-extra-select-wrap'>";
        html += "<select " +
                "class='form-control programacion-acompanante-select' " +
                "name='id_documento[" + contadorDocumentos + "]' " +
                "id='id_documento" + contadorDocumentos + "' " +
                "required>";
        html += "<option value=''>Selecciona un acompañante...</option>";
        html += lista;
        html += "</select>";
        html += "</div>";
        html += "</td>";
        html += "<td class='text-center programacion-extra-option'>";
        html += "<a href='#' " +
                "class='programacion-extra-delete hrefEliminar' " +
                "data-id='" + contadorDocumentos + "' " +
                "title='Eliminar acompañante'>";
        html += "<i class='flaticon-delete'></i>";
        html += "</a>";
        html += "</td>";
        html += "</tr>";

        $("#tbodyDocumentos").append(html);

        $("#id_documento" + contadorDocumentos).select2({
            width: "100%",
            placeholder: "Selecciona un acompañante...",
            allowClear: false,
            dropdownCssClass: "programacion-acompanante-dropdown",
            language: { noResults: function() {return "No se encontraron custodios";},
                        searching: function() {return "Buscando...";}

            }

        });

        validador.addField('id_documento[' + contadorDocumentos + ']', acompananteValidador );
        KTApp.initTooltips();

    };

    var delAcompananteNuevo = function() {

        $(document).on(
            "click",
            ".hrefEliminar",
            function(e) {

                e.preventDefault();

                var id = $(this).data("id");

                validador.removeField('id_documento[' + id + ']');

                $("#trDocumentoNuevo" + id).remove();

            }
        );

    };

    var initSwalEliminarAcompananteExistente = function() {

        $(document).on(
            "click",
            ".hrefEliminarDocumento",
            function(e) {

                e.preventDefault();

                var $boton =$(this);
                var id =$boton.data('id');
                var documento =$boton.data('documento') || '';

                Swal.fire({

                    title:"¿Desea eliminar al acompañante?",
                    text:documento,
                    icon:"warning",
                    showCancelButton:true,
                    confirmButtonText:"Eliminar acompañante",
                    cancelButtonText:"Cerrar",
                    reverseButtons:true

                }).then(function(result) {

                    if (!result.value) {
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: $('#documentoEliminarPath').val(),
                        data: {

                            id:id,
                            _token:$("[name='_token']").val()

                        }

                    }).done(function(data) {

                        if (data.estatus) {

                            $('#trDocumento' + id).remove();
                            toastr.success("El acompañante se eliminó correctamente.");

                        } else {

                            toastr.error("No es posible eliminar al acompañante, intenta más tarde.");

                        }

                    }).fail(function() {
                        toastr.error("Ocurrió un error al eliminar al acompañante.");
                    });

                });

            }
        );

    };

    var initReglasCustodio = function() {

        var ID_SIN_CUSTODIO ="153";
        var ID_CUSTODIO_EMERGENTE ="154";
        var $custodio =$("#custodio_id");
        var $radioSi =$("#op_c_uno");
        var $radioNo =$("#op_c_dos");
        var $contenedorAcompanantes =$("#div_custodios");
        var $contenedorEmergente =$("#contenedor_custodio_emergente");
        var $custodioEmergente =$("#custodio_emergente");


        function mostrarOcultarAcompanantes() {

            if ($radioSi.is(":checked") && $custodio.val() !== ID_SIN_CUSTODIO) {
                $contenedorAcompanantes.stop(true, true).slideDown(180);
            } else {
                $contenedorAcompanantes.stop(true, true).slideUp(180);
            }

        }

        function actualizarEstadoCustodio() {

            var custodioId = $custodio.val();

            if (custodioId === ID_SIN_CUSTODIO) {

                $radioNo.prop("checked",true);
                $radioSi.prop("disabled",true);
                $contenedorAcompanantes.stop(true, true).slideUp(180);
                $contenedorEmergente.stop(true, true).slideUp(180);
                $custodioEmergente.removeAttr("required").val("");

                return;

            }

            $radioSi.prop("disabled",false);

            if (custodioId ===ID_CUSTODIO_EMERGENTE) {

                $contenedorEmergente.stop(true, true).slideDown(180);
                $custodioEmergente.attr("required",true);

            } else {

                $contenedorEmergente.stop(true, true).slideUp(180);
                $custodioEmergente.removeAttr("required").val("");

            }

            mostrarOcultarAcompanantes();

        }

        $custodio.on("change",actualizarEstadoCustodio);

        $radioNo.on(
            "change",
            function() {

                if (this.checked) {
                    mostrarOcultarAcompanantes();
                }

            }
        );

        $radioSi.on("change",
            function() {

                if (!this.checked) {
                    return;
                }

                if ($custodio.val() === ID_SIN_CUSTODIO) {

                    $radioNo.prop("checked",true);
                    mostrarOcultarAcompanantes();
                    toastr.warning("No puedes agregar acompañantes mientras la programación esté sin custodio.");

                    return false;

                }

                mostrarOcultarAcompanantes();

            }
        );

        actualizarEstadoCustodio();

    };

    // INICIALIZACIÓN
    return {

        init: function() {
            initEvents();
            validacion();
            initReglasCustodio();
        }

    };


}();

jQuery(document).ready(
    function() {
    
        Modulo.init();

    }
);