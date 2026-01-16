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

    var eliminarContacto = function () {
        $(document).on("click", ".hrefEliminar", function (e) {
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
