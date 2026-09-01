"use strict";

var ModuloEstadias = function () {

    var form = null;
    var guardando = false;

    var inicializarGuardado = function () {

        form = document.getElementById('submit_estadia');

        var btnGuardar = document.getElementById('btnGuardar');

        if (!form || !btnGuardar) {
            return;
        }

        btnGuardar.addEventListener('click', function (e) {

            e.preventDefault();

            if (guardando) {
                return;
            }

            guardando = true;

            KTUtil.btnWait(
                btnGuardar,
                'spinner spinner-right spinner-white pr-15',
                'Espere...',
                true
            );

            toastr.success(
                'Guardando información, por favor espere...'
            );

            form.submit();

        });

    };


    var inicializarAcompanantes = function () {

        var custodio = document.getElementById('custodio_id');
        var acompanantes = document.getElementById('acompanantes_ids');

        if (!custodio || !acompanantes) {
            return;
        }

        var actualizarOpciones = function () {

            var custodioPrincipal = String(
                custodio.value || ''
            );

            Array.prototype.forEach.call(
                acompanantes.options,
                function (option) {

                    var esPrincipal =
                        custodioPrincipal !== '' &&
                        String(option.value) === custodioPrincipal;

                    option.disabled = esPrincipal;

                    if (esPrincipal && option.selected) {
                        option.selected = false;
                    }

                }
            );

        };

        custodio.addEventListener(
            'change',
            actualizarOpciones
        );

        actualizarOpciones();

    };

    var inicializarLimpiar = function () {

        var btnLimpiar =
            document.getElementById(
                'btnLimpiarEstadia'
            );

        if (!btnLimpiar) {
            return;
        }

        btnLimpiar.addEventListener(
            'click',
            function () {

                Swal.fire({
                    title: '¿Descartar cambios?',
                    text: 'Los campos volverán a los valores con los que abriste esta pantalla.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, limpiar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true

                }).then(function (result) {

                    if (!result.value) {
                        return;
                    }

                    window.location.reload();

                });

            }
        );

    };

    return {

        init: function () {

            inicializarGuardado();
            inicializarAcompanantes();
            inicializarLimpiar();

        }

    };

}();


jQuery(document).ready(function () {
    ModuloEstadias.init();
});