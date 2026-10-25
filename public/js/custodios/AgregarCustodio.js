"use strict";
var Modulo = function() {

    var lista = ''; //lista de elementos
    var lista_vehiculos = ''; //lista de elementos
    var contadorDocumentos=0; //indice contador de elementos
    var validador; //validador del formulario
    var conDocumentos=0;

    var validacion = function() {
        //validacion de formulario
        const form = document.getElementById('submit_cliente');
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

        $("#id_municipio").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });

        $("#id_estado").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });
        
        $("#fecha_ingreso").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#fecha_baja").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#fecha_nacimiento").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#fa_fechainicial").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#fa_verificaciondocumental").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#entin_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#verdoc_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#entope_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });
        // module
        $("#valdat_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#verref_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#verlab_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#anasoc_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#exafis_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#examed_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#exapsi_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#exatox_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#tesver_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#tesrob_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#tesnor_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#tessob_fecha").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows,
            language: "es",
            format: "dd/mm/yyyy",
        });

        $("#users_custodios").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });
        
        
        iniciarCatalogoDocumentos();

        lista = construyeElementosLista();
        lista_vehiculos = construyeavancevehiculosLista();
        //botón agregar otro archivo
        $( ".hrefAgregarOtro" ).on( "click", function(event) {
            event.preventDefault();
            addArchivo();
        });
        delArchivo();

        $( ".hrefAgregarOtro2" ).on( "click", function(event) {
            event.preventDefault();
            addArchivoVehiculo();
        });
        delArchivoVehiculo();

        $(document).on("change","#tblDocumentos select[name^='id_documento[']",
            function () {
                actualizarVigenciaDocumento(this);
                refrescarTiposDocumentos();
            }
        );


    };

    // Catálogo de documentos disponibles.
    var catalogoDocumentos = {};

    // Cargar el catálogo que envía Laravel.
    var iniciarCatalogoDocumentos = function () {
        catalogoDocumentos = JSON.parse($("#tipoArchivo").val() || "{}");
    };

    // Actualizar las opciones disponibles en cada selector.
    var refrescarTiposDocumentos = function () {

        var $selectores = $("#tblDocumentos select[name^='id_documento[']");
        var seleccionados = {};

        // Obtener los tipos que ya se eligieron en otras filas.
        $selectores.each(function () {
            var valor = String($(this).val() || "");

            if (valor) {
                seleccionados[valor] = true;
            }
        });

        // Reconstruir las opciones de cada selector.
        $selectores.each(function () {

            var $select = $(this);
            var actual = String($select.val() || "");

            $select.empty();

            $select.append(
                $("<option>", {
                    value: "",
                    text: "Selecciona una opción"
                })
            );

            $.each(catalogoDocumentos, function (id, documento) {

                id = String(id);

                // No mostrar lo que otra fila ya seleccionó.
                if (seleccionados[id] && id !== actual) {
                    return;
                }

                $select.append(
                    $("<option>", {
                        value: id,
                        text: documento.nombre
                    }).attr("data-vigencia", documento.vigencia)
                );
            });

            // Conservar la selección actual.
            $select.val(actual);
        });
    };

    // Comprobar si todavía queda algún tipo sin seleccionar.
    var hayDocumentosDisponibles = function () {

        var seleccionados = {};

        $("#tblDocumentos select[name^='id_documento[']").each(function () {
            var id = String($(this).val() || "");

            if (id) {
                seleccionados[id] = true;
            }
        });

        return Object.keys(catalogoDocumentos).some(function (id) {
            return !seleccionados[id];
        });
    };

    //construye  elementos de la lista
    var construyeElementosLista = function () {
        var tipoArchivo = $("#tipoArchivo").val();
        var colTipoArchivo = JSON.parse(tipoArchivo);
        var opcion = "";

        $.each(colTipoArchivo, function (id, item) {
            opcion +=
                "<option value='" + id + "' data-vigencia='" +
                item.vigencia + "'>" +
                $("<div>").text(item.nombre).html() +
                "</option>";
        });

        return opcion;
    };

    //Mostrar vigencia
    var actualizarVigenciaDocumento = function (select) {
        var $select = $(select);
        var $fila = $select.closest("tr");
        var $opcion = $select.find("option:selected");
        var $fecha = $fila.find("input[name^='vigencia[']");
        var $contenedor = $fecha.closest("td");

        var idDocumento = $select.attr("id").replace("id_documento", "");
        var requiereVigencia = String($opcion.attr("data-vigencia")) === "1";

        var nombreCampo = "vigencia[" + idDocumento + "]";

        // Quitar la validación anterior, si existe.
        try {
            validador.removeField(nombreCampo);
        } catch (error) {
            // El campo aún no estaba registrado.
        }

        if (requiereVigencia) {
            $contenedor.show();
            $fecha.prop("disabled", false);
            $fecha.prop("required", true);

            validador.addField(nombreCampo, {
                validators: {
                    notEmpty: {
                        message: "Selecciona la fecha de vigencia"
                    },
                    date: {
                        format: "YYYY-MM-DD",
                        message: "Selecciona una fecha válida"
                    }
                }
            });
        } else {
            $fecha.val("");
            $fecha.prop("required", false);
            $fecha.prop("disabled", true);
            $contenedor.hide();
        }
    };


    //construye elementos de avances financiero
    var construyeavancevehiculosLista =function(){
        var tipoArchivo = $("#tipoArchivov").val();
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

        if (!hayDocumentosDisponibles()) {
            toastr.warning("Ya seleccionaste todos los tipos de documentos disponibles.");
            return;
        }

        contadorDocumentos++;
        while (document.getElementById("trDocumento" + contadorDocumentos)) {
            contadorDocumentos++;
        }
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
        actualizarVigenciaDocumento($("#id_documento" + contadorDocumentos)[0]);
        refrescarTiposDocumentos();
        //agrega validación del elemento creado
        validador.addField('archivo[' + contadorDocumentos + ']', archivoValidador);
        validador.addField('id_documento[' + contadorDocumentos + ']', tipoArchivoValidador);
        KTApp.initTooltips(); //inicia tooltip del elemento creado
        KTApp.initFileInput(); //inicia el elemento archivo del elemento creado
    };

    //elimina un elemento
    
    var delArchivo = function () {

        $(document).on("click", ".hrefEliminar", function(e) {
            e.preventDefault();

            var $boton = $(this);
            var $fila = $boton.closest("tr");
            var idDocumento = $boton.attr("data-id");

            // Primero quitamos visualmente la fila.
            // No hay petición AJAX porque aún no está guardada.
            KTApp.hideTooltips();
            $fila.remove();

            // Quitamos las validaciones asociadas.
            // La fecha puede no estar registrada en FormValidation.
            [
                "archivo[" + idDocumento + "]",
                "id_documento[" + idDocumento + "]",
                "vigencia[" + idDocumento + "]"
            ].forEach(function(nombreCampo) {

                try {
                    validador.removeField(nombreCampo);
                } catch (error) {
                    // El campo no tenía validación registrada.
                }

            });

            // Liberar nuevamente el tipo de documento
            // para que pueda seleccionarse en otra fila.
            refrescarTiposDocumentos();

        });

    };





    //agrega el elemento archivo y lista desplegable
    var addArchivoVehiculo = function () {
        contadorDocumentos++;
        var html = '';
        html += ([    "",
            "<tr id='trDocumentov"+contadorDocumentos+"'>",
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
            "    <td>",
            "       <a href='#' class='btn btn-clean btn-icon btn-outline-success mt-1 hrefEliminar2' data-id='"+contadorDocumentos+"' data-toggle='tooltip' data-theme='dark' title='Eliminar'>",
            "           <i class='flaticon-delete'></i>",
            "       </a>",
            "    </td>",
            "</tr>",

            ""].join(""));
        $("#tblDocumentos2 tbody").append(html); //agrega el html creado
        //agrega validación del elemento creado
        validador.addField('archivo[' + contadorDocumentos + ']', archivoValidador);
        validador.addField('id_documento[' + contadorDocumentos + ']', tipoArchivoValidador);
        KTApp.initTooltips(); //inicia tooltip del elemento creado
        KTApp.initFileInput(); //inicia el elemento archivo del elemento creado
    };

    //elimina un elemento
    var delArchivoVehiculo = function () {
        jQuery(document).on("click", ".hrefEliminar2" , function(e) {
            e.preventDefault();
            var idDocumento = $(this).attr("data-id"); //indice del elemento
            KTApp.hideTooltips(); //oculta tooltip
            //elimina la validación del elemento
            validador.removeField('archivo[' + idDocumento + ']');
            validador.removeField('id_documento[' + idDocumento + ']');
            $('#trDocumento2'+idDocumento).remove();//elimina el elemento
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
        },

    };

}();

jQuery(document).ready(function() {
    Modulo.init();
});

$(document).ready(function(){

    $('input[name="op_custodios"]').change(function(){

        if($(this).val() == "1"){

            $('#select_acompanante').slideDown();

        }else{

            $('#select_acompanante').slideUp();

        }

    });

});