"use strict";
var Modulo = function () {

    var lista = '';
    var lista_dos = '';

    // 🔹 CONTADORES SEPARADOS (CLAVE)
    var contadorContactos = 0;
    var contadorContactosFac = 0;
    var contadorDocs = 0;

    var validador;

    /* ================= VALIDACIÓN ================= */
    var validacion = function () {

        const form = document.getElementById('submit_cliente');

        validador = FormValidation.formValidation(form, {
            locale: 'es_ES',
            localization: FormValidation.locales.es_ES,
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                submitButton: new FormValidation.plugins.SubmitButton(),
                declarative: new FormValidation.plugins.Declarative({ html5Input: true }),
                bootstrap: new FormValidation.plugins.Bootstrap()
            }
        })
        .on('core.form.valid', function () {
            toastr.success("Guardando, por favor espere...");
        })
        .on('core.form.invalid', function () {
            toastr.warning("Por favor, ingrese la información marcada en rojo.");
            KTUtil.scrollTop();
        });

        $("#btnGuardar").on("click", function (e) {
            e.preventDefault();
            validador.validate().then(function (status) {
                if (status === 'Valid') {
                    KTUtil.btnWait(this, 'spinner spinner-right spinner-white pr-15', 'Espere...', true);
                    form.submit();
                }
            }.bind(this));
        });
    };

    /* ================= EVENTOS ================= */
    var initEvents = function () {

        $("#costo_estadia, #costo_km, #costo_estadia_armada").inputmask('$ 999,999,999.99', {
            numericInput: true
        });

<<<<<<< HEAD
=======
        $("#costo_km").inputmask('$ 999,999,999.99', {
            numericInput: true
        });

        $("#servicio_arma").inputmask('$ 999,999,999.99', {
            numericInput: true
        });

        $("#servicio_sin_arma").inputmask('$ 999,999,999.99', {
            numericInput: true
        });

        $("#costo_estadia_armada").inputmask('$ 999,999,999.99', {
            numericInput: true
        });
        

>>>>>>> d039a95fbd0fd75c838ecc8adbd7165591c0b552
        lista = construyeElementosLista();
        lista_dos = construyeElementosListados();

        $(".hrefAgregarOtro").on("click", function (e) {
            e.preventDefault();
            addContacto();
        });

        $(".hrefAgregarOtro2").on("click", function (e) {
            e.preventDefault();
            addDocumento();
        });

        eliminarContacto();
        eliminarDocumento();

        // Mostrar nombre del archivo seleccionado
        $(document).on('change', '.custom-file-input', function () {
            let fileName = this.files[0]?.name || 'Selecciona un archivo';
            $(this).next('.custom-file-label').text(fileName);
        });
    };

    /* ================= LISTAS ================= */
    var construyeElementosLista = function () {
        var col = JSON.parse($("#tipoArchivo").val());
        return Object.entries(col).map(([k, v]) =>
            `<option value="${k}">${v}</option>`
        ).join('');
    };

    var construyeElementosListados = function () {
        var col = JSON.parse($("#tipoArchivo2").val());
        return Object.entries(col).map(([k, v]) =>
            `<option value="${k}">${v}</option>`
        ).join('');
    };

    /* ================= VALIDADORES ================= */
    const archivoValidador = {
        validators: {
            notEmpty: { message: 'Campo obligatorio' }
        }
    };

    const fileValidador = {
        validators: {
            notEmpty: { message: 'Archivo obligatorio' },
            file: {
                extension: 'jpeg,jpg,png,pdf,docx,xls,gif,ppt,bmp',
                message: 'Archivo no permitido'
            }
        }
    };

    /* ================= CONTACTO OPERATIVO ================= */
    var addContacto = function () {
        contadorContactos++;

        let html = `
        <tr id="trContacto${contadorContactos}">
            <td>
                <select class="form-control" name="id_tipocontacto[${contadorContactos}]" required>
                    <option value="">Seleccione</option>${lista_dos}
                </select>
            </td>
            <td><input class="form-control" name="nombre[${contadorContactos}]" required></td>
            <td><input class="form-control" name="email[${contadorContactos}]" required></td>
            <td><input class="form-control" name="telefono[${contadorContactos}]" required></td>
            <td>
                <a href="#" class="btn btn-icon btn-light-danger hrefEliminar" data-id="${contadorContactos}">
                    <i class="flaticon-delete"></i>
                </a>
            </td>
        </tr>`;

        $("#tblDocumentos tbody").append(html);

        validador.addField(`id_tipocontacto[${contadorContactos}]`, archivoValidador);
        validador.addField(`nombre[${contadorContactos}]`, archivoValidador);
        validador.addField(`email[${contadorContactos}]`, archivoValidador);
        validador.addField(`telefono[${contadorContactos}]`, archivoValidador);
    };

<<<<<<< HEAD
    var eliminarContacto = function () {
        $(document).on("click", ".hrefEliminar", function (e) {
=======
    //agrega el elemento archivo y lista desplegable
    var addArchivo = function () {
        contadorDocumentos++;
        var html = '';
        html += ([    "",
            "<tr id='trDocumento"+contadorDocumentos+"'>",
            "    <td>" +
            "       <div class='form-group mb-0'>" +
            "          <select class='form-control  st-input' name='id_tipocontacto["+contadorDocumentos+"]' id='id_tipocontacto"+contadorDocumentos+"' required>",
            "              <option value=''>Selecciona un opción</option>",
            lista_dos,
            "          </select>",
            "       </div>" +
            "    </td>",
            "    <td>" +
            "       <div class='form-group mb-0'>" +
            "               <input type='text' class='form-control  st-input' id='nombre"+contadorDocumentos+"' name='nombre["+contadorDocumentos+"]' required />",
            "       </div>" +
            "    </td>",
            "    <td>" +
            "       <div class='form-group mb-0'>" +
            "               <input type='text' class='form-control  st-input' id='email"+contadorDocumentos+"' name='email["+contadorDocumentos+"]' required />",
            "       </div>" +
            "    </td>",
            "    <td>" +
            "       <div class='form-group mb-0'>" +
            "               <input type='text' class='form-control  st-input' id='telefono"+contadorDocumentos+"' name='telefono["+contadorDocumentos+"]' required />",
            "       </div>" +
            "    </td>",
            "    <td>",
            "       <a href='#' class='btn btn-clean btn-icon btn-outline-danger mt-1 hrefEliminar' data-id='"+contadorDocumentos+"' data-toggle='tooltip' data-theme='dark' title='Eliminar'>",
            "           <i class='flaticon-delete'></i>",
            "       </a>",
            "    </td>",
            "</tr>",

            ""].join(""));
        $("#tblDocumentos tbody").append(html); //agrega el html creado
        //agrega validación del elemento creado
        validador.addField('id_tipocontacto[' + contadorDocumentos + ']', archivoValidador);
        validador.addField('nombre[' + contadorDocumentos + ']', archivoValidador);
        validador.addField('email[' + contadorDocumentos + ']', archivoValidador);
        validador.addField('telefono[' + contadorDocumentos + ']', archivoValidador);
        KTApp.initTooltips(); //inicia tooltip del elemento creado
        KTApp.initFileInput(); //inicia el elemento archivo del elemento creado
    };

    //elimina un elemento
    var delArchivo = function () {
        jQuery(document).on("click", ".hrefEliminar" , function(e) {
>>>>>>> 9f7373ad738e51fdcfda16ac83aa291304678035
            e.preventDefault();
            let id = $(this).data("id");

            validador.removeField(`id_tipocontacto[${id}]`);
            validador.removeField(`nombre[${id}]`);
            validador.removeField(`email[${id}]`);
            validador.removeField(`telefono[${id}]`);

            $("#trContacto" + id).remove();
        });
    };

    /* ================= DOCUMENTOS ================= */
    var addDocumento = function () {
        contadorDocs++;

        let html = `
        <tr id="trDocumento${contadorDocs}">
            <td>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="archivo[${contadorDocs}]" required>
                    <label class="custom-file-label">Selecciona un archivo</label>
                </div>
            </td>
            <td>
                <select class="form-control" name="id_documento[${contadorDocs}]" required>
                    <option value="">Seleccione</option>${lista}
                </select>
            </td>
            <td>
                <a href="#" class="btn btn-icon btn-light-danger hrefEliminarDoc" data-id="${contadorDocs}">
                    <i class="flaticon-delete"></i>
                </a>
            </td>
        </tr>`;

        $("#tblDocumentos2 tbody").append(html);

        validador.addField(`archivo[${contadorDocs}]`, fileValidador);
        validador.addField(`id_documento[${contadorDocs}]`, archivoValidador);
    };

    var eliminarDocumento = function () {
        $(document).on("click", ".hrefEliminarDoc", function (e) {
            e.preventDefault();
            let id = $(this).data("id");

            validador.removeField(`archivo[${id}]`);
            validador.removeField(`id_documento[${id}]`);

            $("#trDocumento" + id).remove();
        });
    };

<<<<<<< HEAD
=======
    //agrega el elemento archivo y lista desplegable
    var addArchivo2 = function () {
        contadorDocumentos++;
        var html = '';
        html += ([    "",
            "<tr id='trDocumento2"+contadorDocumentos+"'>",
            "    <td>",
            "        <div class='form-group mb-0'>",
            "           <div class='custom-file'>",
            "               <input type='file' class='custom-file-input st-input' id='archivo"+contadorDocumentos+"' name='archivo["+contadorDocumentos+"]' required />",
            "               <label class='custom-file-label' for='archivo"+contadorDocumentos+"'>Selecciona un archivo</label>",
            "           </div>",
            "        </div>",
            "    </td>",
            "    <td>" +
            "       <div class='form-group mb-0'>" +
            "          <select class='form-control st-input' name='id_documento["+contadorDocumentos+"]' id='id_documento"+contadorDocumentos+"' required>",
            "              <option value=''>Selecciona un opción</option>",
            lista,
            "          </select>",
            "       </div>" +
            "    </td>",
            "    <td>",
            "       <a href='#' class='btn btn-clean btn-icon btn-outline-danger btn-icon hrefEliminar2' data-id='"+contadorDocumentos+"' data-toggle='tooltip' data-theme='dark' title='Eliminar'>",
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
    var delArchivo2 = function () {
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

>>>>>>> 9f7373ad738e51fdcfda16ac83aa291304678035
    return {
        init: function () {
            initEvents();
            validacion();
        }
    };

}();

jQuery(document).ready(function () {
    Modulo.init();
});
