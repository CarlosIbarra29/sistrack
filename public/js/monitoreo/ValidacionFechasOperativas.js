
"use strict";

/* ==========================================================
   SISTRACK - VALIDACIÓN DE FECHAS OPERATIVAS
   ========================================================== */

window.SistrackFechas = (function () {

    const campos = [
        "fechahora_llegada_custodio",
        "fechahora_inicio_trayecto",
        "fechahora_llegado_destino",
        "fechahora_finalizacion"
    ];

    const nombres = [
        "Llegada punto Origen",
        "Inicio de servicio",
        "Arribo punto de destino",
        "Finalización de servicio"
    ];

    function validar(inputs) {
        for (let i = 0; i < inputs.length; i++) {
            if (!inputs[i] || !inputs[i].value) continue;

            for (let j = i + 1; j < inputs.length; j++) {
                if (!inputs[j] || !inputs[j].value) continue;

                if (inputs[i].value > inputs[j].value) {
                    return nombres[i] +
                        " no puede ser posterior a " +
                        nombres[j] + ".";
                }
            }
        }

        return null;
    }

    function obtenerInputs(contenedor) {
        return campos.map(function (campo) {
            return contenedor.querySelector(
                '[data-campo="' + campo + '"], ' +
                '[name="' + campo + '"]'
            );
        });
    }

    function configurar(contenedor, fechaServicio, alCambiar) {
        const inputs = obtenerInputs(contenedor);

        function actualizar() {
            const tieneFecha = Boolean(fechaServicio.value);

            inputs.forEach(function (input, indice) {
                if (!input) return;

                input.disabled = !tieneFecha;

                let minimo = "";
                let maximo = "";

                for (let i = 0; i < indice; i++) {
                    if (inputs[i] && inputs[i].value) {
                        if (!minimo || inputs[i].value > minimo) {
                            minimo = inputs[i].value;
                        }
                    }
                }

                for (let i = indice + 1; i < inputs.length; i++) {
                    if (inputs[i] && inputs[i].value) {
                        if (!maximo || inputs[i].value < maximo) {
                            maximo = inputs[i].value;
                        }
                    }
                }

                input.min = minimo;
                input.max = maximo;
            });
        }

        inputs.forEach(function (input) {
            if (!input) return;

            input.addEventListener("focus", function () {
                input.dataset.valorAnterior = input.value;
            });

            input.addEventListener("change", function (evento) {
                const error = validar(inputs);

                if (error) {
                    evento.stopImmediatePropagation();

                    input.value =
                        input.dataset.valorAnterior || "";

                    actualizar();

                    if (typeof Swal !== "undefined") {
                        Swal.fire(
                            "Fecha incorrecta",
                            error,
                            "warning"
                        );
                    } else {
                        alert(error);
                    }

                    return;
                }

                actualizar();

                if (typeof alCambiar === "function") {
                    alCambiar(input);
                }
            });
        });

        fechaServicio.addEventListener("change", actualizar);
        actualizar();

        return {
            validar: function () {
                if (!fechaServicio.value &&
                    inputs.some(function (input) {
                        return input && Boolean(input.value);
                    })) {
                    return "No puedes registrar fechas operativas sin fecha de servicio.";
                }

                return validar(inputs);
            },
            actualizar: actualizar
        };
    }

    return {
        configurar: configurar,
        validar: validar,
        campos: campos
    };

})();
