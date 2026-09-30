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

            var custodioPrincipal = String(custodio.value || '');

            var sinCustodio = custodioPrincipal === '153';

            if (sinCustodio) {

                acompanantes.disabled = true;

                Array.prototype.forEach.call( acompanantes.options,
                    function (option) {
                        option.selected = false;
                        option.disabled = false;
                    }
                );

                return;
            }

            acompanantes.disabled = false;

            Array.prototype.forEach.call(acompanantes.options,
                function (option) {

                    var valor = String(option.value || '');
                    var esPrincipal = custodioPrincipal !== '' && valor === custodioPrincipal;
                    var esSinCustodio = valor === '153';
                    option.disabled = esPrincipal || esSinCustodio;

                    if ((esPrincipal || esSinCustodio) && option.selected) {
                        option.selected = false;
                    }
                }
            );

        };

        custodio.addEventListener( 'change', actualizarOpciones);


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

    var inicializarTransportes = function () {

        var container =document.getElementById('transportesContainer');
        var btnAgregar =document.getElementById('btnAgregarTransporte');
        var template =document.getElementById('templateTransporte');

        if (!container || !btnAgregar || !template) {
            return;
        }

        var reindexarTransportes = function () {

            var items = container.querySelectorAll('[data-transporte-item]' );


            Array.prototype.forEach.call(
                items,
                function (item, index) {

                    var numero =item.querySelector('.transport-unit-number');

                    if (numero) {
                        numero.textContent ='Transporte ' + (index + 1);
                    }

                    var campos = item.querySelectorAll('[data-field]');

                    Array.prototype.forEach.call(
                        campos,
                        function (campo) {

                            var nombre = campo.getAttribute('data-field');
                            campo.name ='transportes[' +index +'][' + nombre +']';

                        }
                    );

                }
            );

            var botonesEliminar =container.querySelectorAll('[data-remove-transporte]');

            Array.prototype.forEach.call(
                botonesEliminar,
                function (boton) {

                    boton.style.display =
                        items.length > 1
                            ? ''
                            : 'none';

                }
            );

        };

        var prepararExistentes = function () {

            var items =container.querySelectorAll('[data-transporte-item]');

            Array.prototype.forEach.call(
                items,
                function (item) {

                    var campos =item.querySelectorAll('input[name], textarea[name]');

                    Array.prototype.forEach.call(
                        campos,
                        function (campo) {

                            var name = campo.getAttribute('name') || '';
                            var coincidencia = name.match(/\[([^\]]+)\]$/);

                            if (coincidencia) {
                                campo.setAttribute('data-field',coincidencia[1]);
                            }

                        }
                    );

                }
            );

        };

        btnAgregar.addEventListener(
            'click',
            function () {

                var fragmento =template.content.cloneNode(true);
                container.appendChild(fragmento);
                reindexarTransportes();

                var items =container.querySelectorAll('[data-transporte-item]');
                var ultimo =items[items.length - 1];

                if (ultimo) {

                    ultimo.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                }

            }
        );

        container.addEventListener(
            'click',
            function (e) {

                var boton = e.target.closest('[data-remove-transporte]');

                if (!boton) {
                    return;
                }

                var items = container.querySelectorAll('[data-transporte-item]');

                if (items.length <= 1) {
                    return;
                }

                var item =boton.closest('[data-transporte-item]');

                if (!item) { return;}

                Swal.fire({

                    title: '¿Eliminar transporte?',
                    text:'Los datos de este transporte dejarán de estar asociados al servicio.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText:'Sí, eliminar',
                    cancelButtonText:'Cancelar',
                    reverseButtons: true

                }).then(function (result) {

                    if (!result.value) {
                        return;
                    }

                    item.remove();
                    reindexarTransportes();

                });

            }
        );

        prepararExistentes();
        reindexarTransportes();

    };

    return {

        init: function () {

            inicializarGuardado();
            inicializarAcompanantes();
            inicializarTransportes();
            inicializarLimpiar();

        }

    };

}();


jQuery(document).ready(function () {
    ModuloEstadias.init();
});