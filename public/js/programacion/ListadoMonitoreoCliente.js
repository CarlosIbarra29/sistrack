'use strict';


document.addEventListener('DOMContentLoaded', function () {


    const tabla = document.getElementById('cliente_monitor_tabla');

    if (!tabla) {
        return;
    }

    const filas = Array.from(
        tabla.querySelectorAll('tbody tr')
    );

    const estado = document.getElementById('cliente_monitor_estado');
    const buscar = document.getElementById('cliente_monitor_buscar');
    const length = document.getElementById('cliente_monitor_length');
    const total = document.getElementById('cliente_monitor_total');
    const info = document.getElementById('cliente_monitor_info');
    const vacio = document.getElementById('cliente_monitor_vacio');
    const paginas = document.getElementById('cliente_monitor_paginas');

    let pagina = 1;

    const normalizar = texto => String(texto || '')
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '');

    function render() {

        const termino = normalizar(
            buscar.value.trim()
        );

        const filtradas = filas.filter(fila => {

            const coincideEstado =
                !estado.value ||
                fila.dataset.estado === estado.value;

            const coincideBusqueda =
                !termino ||
                normalizar(fila.textContent).includes(termino);

            return coincideEstado && coincideBusqueda;

        });


        const limite = length.value === 'all'
            ? Math.max(filtradas.length, 1)
            : Number(length.value);

        const numeroPaginas = Math.max(
            1,
            Math.ceil(filtradas.length / limite)
        );

        pagina = Math.min(pagina, numeroPaginas);

        const inicio = (pagina - 1) * limite;

        filas.forEach(fila => {

            fila.hidden = true;
            fila.style.display = 'none';

        });


        filtradas
            .slice(inicio, inicio + limite)
            .forEach(fila => {

                fila.hidden = false;
                fila.style.display = '';

            });

        total.textContent = filtradas.length;

        vacio.hidden = filtradas.length !== 0;

        info.textContent = filtradas.length
            ? `Mostrando ${inicio + 1}–${Math.min(inicio + limite, filtradas.length)} de ${filtradas.length} servicios`
            : '0 servicios encontrados';


        paginas.replaceChildren();

        if (numeroPaginas > 1) {

            const crearBoton = (
                texto,
                destino,
                deshabilitado,
                activo
            ) => {

                const boton = document.createElement('button');

                boton.type = 'button';
                boton.textContent = texto;
                boton.disabled = deshabilitado;

                boton.className =
                    'cliente-monitor-page-btn' +
                    (activo ? ' is-active' : '');

                boton.addEventListener('click', () => {

                    pagina = destino;
                    render();

                });

                paginas.appendChild(boton);

            };


            /* Botón anterior */
            crearBoton(
                '‹',
                pagina - 1,
                pagina === 1,
                false
            );


            /* Números de página */
            for (
                let i = Math.max(1, pagina - 2);
                i <= Math.min(numeroPaginas, pagina + 2);
                i++
            ) {

                crearBoton(
                    i,
                    i,
                    false,
                    i === pagina
                );

            }


            /* Botón siguiente */
            crearBoton(
                '›',
                pagina + 1,
                pagina === numeroPaginas,
                false
            );

        }

    }


    [estado, buscar, length].forEach(control => {

        control.addEventListener(
            control === buscar ? 'input' : 'change',
            () => {

                pagina = 1;
                render();

            }
        );

    });


    document
        .getElementById('cliente_monitor_limpiar')
        .addEventListener('click', () => {

            estado.value = '';
            buscar.value = '';

            pagina = 1;

            render();

        });

    render();

});
