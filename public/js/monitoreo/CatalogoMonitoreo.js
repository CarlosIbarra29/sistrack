"use strict";

/* ==========================================================================
   SISTRACK - MONITOREO
   ========================================================================== */

(function ($) {

    function normalizarTexto(texto) {
        return String(texto || "")
            .toLowerCase()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .trim();
    }

    function getCsrfToken() {
        return $('meta[name="csrf-token"]').attr('content') ||
            $("[name='_token']").first().val() ||
            "";
    }

    var MonitoreoListado = {
        filas: [],
        filtradas: [],
        paginaActual: 1,
        registrosPorPagina: 10,

        init: function () {
            this.tabla = document.getElementById("kdatatable_usuarios2");

            if (!this.tabla) {
                return;
            }

            this.tbody = this.tabla.querySelector("tbody");
            this.filtroServicio = document.getElementById("monitoreo_filtro_servicio");
            this.filtroEstatus = document.getElementById("monitoreo_filtro_estatus");
            this.buscador = document.getElementById("monitoreo_buscar");
            this.btnLimpiar = document.getElementById("monitoreo_limpiar_filtros");
            this.btnActualizar = document.getElementById("monitoreo_actualizar");
            this.btnExportar = document.getElementById("monitoreo_exportar");
            this.btnImprimir = document.getElementById("monitoreo_imprimir");
            this.info = document.getElementById("monitoreo_info");
            this.paginador = document.getElementById("monitoreo_paginador");
            this.totalBadge = document.getElementById("monitoreo_total");
            this.empty = document.getElementById("monitoreo_sin_resultados");

            this.filas = Array.prototype.slice.call(
                this.tbody.querySelectorAll("[data-monitoreo-row]")
            );

            this.actualizarBusquedaTodas();
            this.filtradas = this.filas.slice();

            this.eventos();
            this.render();
        },

        eventos: function () {
            var self = this;

            if (this.filtroServicio) {
                this.filtroServicio.addEventListener("change", function () {
                    self.filtrar();
                });
            }

            if (this.filtroEstatus) {
                this.filtroEstatus.addEventListener("change", function () {
                    self.filtrar();
                });
            }

            if (this.buscador) {
                this.buscador.addEventListener("input", function () {
                    self.filtrar();
                });
            }

            if (this.btnLimpiar) {
                this.btnLimpiar.addEventListener("click", function () {
                    if (self.filtroServicio) {
                        self.filtroServicio.value = "";
                    }

                    if (self.filtroEstatus) {
                        self.filtroEstatus.value = "";
                    }

                    if (self.buscador) {
                        self.buscador.value = "";
                    }

                    self.paginaActual = 1;
                    self.filtrar();
                });
            }

            if (this.btnActualizar) {
                this.btnActualizar.addEventListener("click", function () {
                    window.location.reload();
                });
            }

            if (this.btnExportar) {
                this.btnExportar.addEventListener("click", function () {
                    self.exportarCSV();
                });
            }

            if (this.btnImprimir) {
                this.btnImprimir.addEventListener("click", function () {
                    window.print();
                });
            }
        },

        actualizarBusquedaTodas: function () {
            var self = this;

            this.filas.forEach(function (fila) {
                self.actualizarBusquedaFila(fila);
            });
        },

        actualizarBusquedaFila: function (fila) {
            var datos = [];

            Array.prototype.forEach.call(fila.cells, function (celda) {

                if (celda.querySelector(".monitoreo-row-actions")) {
                    return;
                }

                var select = celda.querySelector("select");

                if (select && select.selectedIndex >= 0) {
                    datos.push(
                        select.options[select.selectedIndex].text.trim()
                    );

                    return;
                }

                datos.push(
                    (celda.innerText || "")
                        .replace(/\s+/g, " ")
                        .trim()
                );
            });

            fila.dataset.searchText = normalizarTexto(
                datos.join(" ")
            );
        },

        filtrar: function () {
            var servicio = this.filtroServicio ? this.filtroServicio.value : "";
            var estatus = this.filtroEstatus ? this.filtroEstatus.value : "";
            var termino = normalizarTexto(this.buscador ? this.buscador.value : "");

            this.filtradas = this.filas.filter(function (fila) {
                var coincideServicio =
                    !servicio ||
                    fila.dataset.folio === servicio;

                var coincideEstatus =
                    !estatus ||
                    String(fila.dataset.statusId) === String(estatus);

                var coincideTexto =
                    !termino ||
                    (fila.dataset.searchText || "").indexOf(termino) !== -1;

                return coincideServicio && coincideEstatus && coincideTexto;
            });

            this.paginaActual = 1;
            this.render();
        },

        render: function () {
            var self = this;

            this.filas.forEach(function (fila) {
                fila.style.display = "none";
            });

            var total = this.filtradas.length;
            var totalPaginas = Math.max(
                1,
                Math.ceil(total / this.registrosPorPagina)
            );

            if (this.paginaActual > totalPaginas) {
                this.paginaActual = totalPaginas;
            }

            var inicio =
                (this.paginaActual - 1) *
                this.registrosPorPagina;

            var fin = inicio + this.registrosPorPagina;

            var pagina = this.filtradas.slice(inicio, fin);

            pagina.forEach(function (fila) {
                fila.style.display = "";
            });

            if (this.empty) {
                this.empty.classList.toggle(
                    "is-visible",
                    total === 0
                );
            }

            if (this.totalBadge) {
                this.totalBadge.textContent = total;
            }

            this.renderInfo(total, inicio, pagina.length);
            this.renderPaginador(totalPaginas, total);
        },

        renderInfo: function (total, inicio, cantidad) {
            if (!this.info) {
                return;
            }

            if (total === 0) {
                this.info.textContent = "0 servicios encontrados";
                return;
            }

            this.info.textContent =
                "Mostrando " +
                (inicio + 1) +
                " - " +
                (inicio + cantidad) +
                " de " +
                total +
                " servicios";
        },

        renderPaginador: function (totalPaginas, total) {
            var self = this;

            if (!this.paginador) {
                return;
            }

            this.paginador.innerHTML = "";

            if (total <= this.registrosPorPagina) {
                return;
            }

            this.paginador.appendChild(
                this.crearBotonPagina(
                    "‹",
                    this.paginaActual - 1,
                    this.paginaActual === 1,
                    false
                )
            );

            this.obtenerPaginas(totalPaginas).forEach(function (pagina) {
                self.paginador.appendChild(
                    self.crearBotonPagina(
                        pagina,
                        pagina,
                        false,
                        pagina === self.paginaActual
                    )
                );
            });

            this.paginador.appendChild(
                this.crearBotonPagina(
                    "›",
                    this.paginaActual + 1,
                    this.paginaActual === totalPaginas,
                    false
                )
            );
        },

        obtenerPaginas: function (totalPaginas) {
            var maximo = 5;
            var inicio = Math.max(1, this.paginaActual - 2);
            var fin = Math.min(totalPaginas, inicio + maximo - 1);

            if ((fin - inicio + 1) < maximo) {
                inicio = Math.max(
                    1,
                    fin - maximo + 1
                );
            }

            var paginas = [];

            for (var i = inicio; i <= fin; i++) {
                paginas.push(i);
            }

            return paginas;
        },

        crearBotonPagina: function (texto, pagina, disabled, active) {
            var self = this;
            var boton = document.createElement("button");

            boton.type = "button";
            boton.className = "monitoreo-page-button";
            boton.textContent = texto;
            boton.disabled = disabled;

            if (active) {
                boton.classList.add("active");
            }

            boton.addEventListener("click", function () {
                if (disabled) {
                    return;
                }

                self.paginaActual = pagina;
                self.render();

                var panel = document.querySelector(".monitoreo-services-panel");

                if (panel) {
                    var top =
                        panel.getBoundingClientRect().top +
                        window.pageYOffset -
                        80;

                    window.scrollTo({
                        top: top,
                        behavior: "smooth"
                    });
                }
            });

            return boton;
        },

        exportarCSV: function () {

            if (!this.filtradas.length) {

                Swal.fire(
                    "Sin información",
                    "No hay servicios para exportar con los filtros actuales.",
                    "info"
                );

                return;
            }

            var tabla = this.tabla;

            if (!tabla) {
                return;
            }

            var encabezados = [];

            Array.prototype.forEach.call(
                tabla.querySelectorAll("thead th"),
                function (th, index) {

                    if (
                        index ===
                        tabla.querySelectorAll("thead th").length - 1
                    ) {
                        return;
                    }

                    encabezados.push(
                        (th.innerText || "")
                            .replace(/\s+/g, " ")
                            .trim()
                    );
                }
            );

            var filas = [
                encabezados
            ];

            this.filtradas.forEach(function (fila) {

                var datos = [];

                Array.prototype.forEach.call(
                    fila.cells,
                    function (celda, index) {

                        /* Última columna = acciones */
                        if (
                            index ===
                            fila.cells.length - 1
                        ) {
                            return;
                        }

                        var select =
                            celda.querySelector(
                                "select"
                            );

                        if (
                            select &&
                            select.selectedIndex >= 0
                        ) {

                            datos.push(
                                select.options[
                                    select.selectedIndex
                                ].text.trim()
                            );

                            return;
                        }

                        datos.push(
                            (celda.innerText || "")
                                .replace(/\s+/g, " ")
                                .trim()
                        );
                    }
                );

                filas.push(datos);
            });

            var csv = filas
                .map(function (fila) {

                    return fila
                        .map(function (valor) {

                            return '"' +
                                String(valor)
                                    .replace(/"/g, '""') +
                                '"';

                        })
                        .join(",");

                })
                .join("\r\n");

            var blob = new Blob(
                [
                    "\uFEFF" + csv
                ],
                {
                    type:
                        "text/csv;charset=utf-8;"
                }
            );

            var url =URL.createObjectURL( blob);
            var link =document.createElement("a");

            link.href = url;

            link.download ="servicios_monitoreo.csv";
            document.body.appendChild(link);

            link.click();
            document.body.removeChild( link);
            URL.revokeObjectURL(url);
        },
    };

    /* ======================================================================
       ACTUALIZACIÓN AJAX DE ESTATUS DESDE LISTADO
       ====================================================================== */

    // $(document).on(
    //     "change",
    //     'select[data-role="estatus-programacion"]',
    //     function () {

    //         var $select = $(this);
    //         var programacion = $select.data("programacion");
    //         var estatusAnterior = $select.data("estatus-anterior");
    //         var estatusNuevo = $select.val();
    //         var url = $("#url_estatus").val();

    //         if (!url) {
    //             Swal.fire(
    //                 "Error",
    //                 "No se encontró la ruta para actualizar el estatus.",
    //                 "error"
    //             );

    //             return;
    //         }

    //         $select.prop("disabled", true);
    //         $select.addClass("is-updating");

    //         $.ajax({
    //             url: url,
    //             type: "POST",

    //             headers: {
    //                 "X-CSRF-TOKEN": getCsrfToken()
    //             },

    //             data: {
    //                 id: estatusNuevo,
    //                 id_programacio: programacion,
    //                 _token: getCsrfToken()
    //             },

    //             success: function () {
    //                 var fila = $select.closest("[data-monitoreo-row]")[0];

    //                 if (fila) {
    //                     fila.dataset.statusId = estatusNuevo;
    //                     MonitoreoListado.actualizarBusquedaFila(fila);
    //                 }

    //                 $select.data("estatus-anterior", estatusNuevo);

    //                 Swal.fire({
    //                     title: "Actualizado",
    //                     text: "El estatus se actualizó correctamente.",
    //                     icon: "success",
    //                     timer: 1500,
    //                     showConfirmButton: false
    //                 });
    //             },

    //             error: function (xhr) {
    //                 if (estatusAnterior) {
    //                     $select.val(estatusAnterior);
    //                 }

    //                 console.error(xhr);

    //                 Swal.fire(
    //                     "No fue posible actualizar",
    //                     "Ocurrió un error al cambiar el estatus.",
    //                     "error"
    //                 );
    //             },

    //             complete: function () {
    //                 $select
    //                     .prop("disabled", false)
    //                     .removeClass("is-updating");
    //             }
    //         });
    //     }
    // );

    // $(document).on(
    //     "focus",
    //     'select[data-role="estatus-programacion"]',
    //     function () {
    //         $(this).data(
    //             "estatus-anterior",
    //             $(this).val()
    //         );
    //     }
    // );


    /* ======================================================================
   ACTUALIZACIÓN AJAX DE ESTATUS DESDE LISTADO
   ====================================================================== */

    function actualizarSemaforoEstatus($select) {

        var estatus = parseInt($select.val(), 10);
        var $dot = $select.closest(".monitoreo-status-wrapper").find('[data-role="estatus-semaforo"]');

        $dot.removeClass(
            "monitoreo-status-dot--gris " +
            "monitoreo-status-dot--verde " +
            "monitoreo-status-dot--rojo " +
            "monitoreo-status-dot--amarillo"
        );

        if (estatus === 1) {

            $dot.addClass("monitoreo-status-dot--gris");

        } else if (estatus === 3) {

            $dot.addClass("monitoreo-status-dot--verde");

        } else if (estatus === 10) {

            $dot.addClass("monitoreo-status-dot--rojo");

        } else {

            $dot.addClass("monitoreo-status-dot--amarillo");
        }
    }


    $(document).on(
        "focus",
        'select[data-role="estatus-programacion"]',
        function () {

            $(this).data(
                "estatus-anterior",
                $(this).val()
            );
        }
    );


    $(document).on(
        "change",
        'select[data-role="estatus-programacion"]',
        function () {

            var $select = $(this);

            var programacion = $select.data("programacion");
            var estatusAnterior = String(
                $select.data("estatus-anterior") || ""
            );

            var estatusNuevo = String($select.val());

            var textoNuevo = $select
                .find("option:selected")
                .text()
                .trim();

            var url = $("#url_estatus").val();


            if (estatusAnterior === estatusNuevo) {
                return;
            }


            Swal.fire({
                title: "¿Cambiar estatus?",
                text: "El servicio cambiará a \"" + textoNuevo + "\".",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, actualizar",
                cancelButtonText: "Cancelar",
                reverseButtons: true

            }).then(function (result) {

                if (!result.value) {

                    $select.val(estatusAnterior);

                    actualizarSemaforoEstatus($select);

                    return;
                }


                $select
                    .prop("disabled", true)
                    .addClass("is-updating");


                $.ajax({

                    url: url,

                    type: "POST",

                    headers: {
                        "X-CSRF-TOKEN": getCsrfToken()
                    },

                    data: {
                        id: estatusNuevo,
                        id_programacio: programacion,
                        _token: getCsrfToken()
                    },


                    success: function () {

                        var fila = $select
                            .closest("[data-monitoreo-row]")[0];

                        if (parseInt(estatusNuevo, 10) === 7) {

                            if (fila) {

                                MonitoreoListado.filas =
                                    MonitoreoListado.filas.filter(
                                        function (item) {
                                            return item !== fila;
                                        }
                                    );

                                MonitoreoListado.filtradas =
                                    MonitoreoListado.filtradas.filter(
                                        function (item) {
                                            return item !== fila;
                                        }
                                    );

                                fila.remove();

                                MonitoreoListado.render();
                            }

                        } else {

                            if (fila) {

                                fila.dataset.statusId =estatusNuevo;
                                MonitoreoListado.actualizarBusquedaFila(fila);
                            }

                            actualizarSemaforoEstatus($select);
                            $select.data("estatus-anterior",estatusNuevo);
                        }


                        Swal.fire({
                            title: "Actualizado",
                            text: parseInt(estatusNuevo, 10) === 7
                                ? "El servicio fue enviado a Servicios Finalizados."
                                : "El estatus se actualizó correctamente.",
                            icon: "success",
                            timer: 1600,
                            showConfirmButton: false
                        });
                    },


                    error: function (xhr) {

                        $select.val(estatusAnterior);
                        actualizarSemaforoEstatus($select);
                        console.error(xhr);
                        Swal.fire("No fue posible actualizar","Ocurrió un error al cambiar el estatus.","error");
                    },


                    complete: function () {

                        $select
                            .prop("disabled", false)
                            .removeClass("is-updating");
                    }

                });

            });

        }
    );


    // ACTUALIZACIÓN DE FECHAS OPERATIVAS

    $(document).on(
        "focus",
        '[data-role="fecha-operativa"]',
        function () {

            $(this).data(
                "valor-anterior",
                $(this).val()
            );
        }
    );


    $(document).on(
        "change",
        '[data-role="fecha-operativa"]',
        function () {

            var $input = $(this);
            var programacion = $input.data("programacion");
            var campo = $input.data("campo");
            var valor = $input.val();
            var valorAnterior =$input.data("valor-anterior") || "";
            var url =$("#url_fecha_estadia").val();


            Swal.fire({
                title: "¿Actualizar fecha?",
                text: "La fecha operativa del servicio será modificada.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, actualizar",
                cancelButtonText: "Cancelar",
                reverseButtons: true

            }).then(function (result) {

                if (!result.value) {
                    $input.val(valorAnterior);
                    return;
                }

                $input.prop("disabled", true);

                $.ajax({

                    url: url,
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": getCsrfToken()
                    },

                    data: {
                        id_programacion: programacion,
                        campo: campo,
                        valor: valor,
                        _token: getCsrfToken()
                    },

                    success: function () {

                        $input.data("valor-anterior",valor);

                        Swal.fire({
                            title: "Fecha actualizada",
                            icon: "success",
                            timer: 1200,
                            showConfirmButton: false
                        });
                    },

                    error: function (xhr) {
                        $input.val(valorAnterior);
                        console.error(xhr);
                        Swal.fire("No fue posible actualizar","La fecha no pudo ser guardada.","error");
                    },

                    complete: function () {
                        $input.prop("disabled",false);
                    }

                });

            });

        }
    );

    // ACTUALIZACIÓN DE PUNTUALIDAD


    function actualizarVisualPuntualidad($select) {

        var valor = parseInt($select.val(),10);
        var $wrapper =$select.closest(".monitoreo-puntualidad-wrapper");
        var $dot =$wrapper.find('[data-role="puntualidad-semaforo"]');
        var $fila =$select.closest("[data-monitoreo-row]");
        var $causa =$fila.find('[data-role="puntualidad-causa"]');

        $dot.removeClass("monitoreo-puntualidad-dot--gris " +"monitoreo-puntualidad-dot--verde " +"monitoreo-puntualidad-dot--rojo");

        if (!valor) {

            $dot.addClass("monitoreo-puntualidad-dot--gris");
            $causa.text("-");
            return;
        }

        if (valor === 1) {
            $dot.addClass("monitoreo-puntualidad-dot--verde");
            $causa.text("-");
            return;
        }

        $dot.addClass("monitoreo-puntualidad-dot--rojo");

        var causa =$select.find("option:selected").data("causa");

        $causa.text(causa || "-");
    }


    $(document).on(
        "focus",
        '[data-role="puntualidad"]',
        function () {

            $(this).data(
                "puntualidad-anterior",
                $(this).val()
            );
        }
    );


    $(document).on(
        "change",
        '[data-role="puntualidad"]',
        function () {

            var $select = $(this);
            var programacion = $select.data("programacion");
            var anterior = String($select.data("puntualidad-anterior") || "");
            var nuevo = String($select.val());
            var texto = $select.find("option:selected").text().trim();
            var url = $("#url_itinerario").val();

            Swal.fire({
                title: "¿Actualizar puntualidad?",
                text: nuevo
                    ? "La puntualidad cambiará a \"" + texto + "\"."
                    : "Se quitará el estatus de puntualidad.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, actualizar",
                cancelButtonText: "Cancelar",
                reverseButtons: true

            }).then(function (result) {

                if (!result.value) {
                    $select.val(anterior);
                    actualizarVisualPuntualidad($select);
                    return;
                }

                $select.prop("disabled",true);

                $.ajax({

                    url: url,
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN":
                            getCsrfToken()
                    },

                    data: {
                        id_programacion:programacion,
                        estatus_itinerario:nuevo,
                        _token:getCsrfToken()
                    },

                    success: function () {

                        $select.data("puntualidad-anterior",nuevo);
                        actualizarVisualPuntualidad($select);

                        var fila =$select.closest("[data-monitoreo-row]")[0];

                        if (fila) {
                            MonitoreoListado.actualizarBusquedaFila(fila);
                        }


                        Swal.fire({
                            title:
                                "Puntualidad actualizada",
                            icon: "success",
                            timer: 1200,
                            showConfirmButton: false
                        });
                    },


                    error: function (xhr) {
                        $select.val(anterior);
                        actualizarVisualPuntualidad($select);
                        console.error(xhr);
                        Swal.fire("No fue posible actualizar","La puntualidad no pudo ser guardada.","error");
                    },


                    complete: function () {
                        $select.prop("disabled",false);
                    }

                });

            });

        }
    );

    /* ======================================================================
       MODAL DE INCIDENCIAS
       ====================================================================== */

    $(document).on(
        "click",
        ".js-add-incidencia",
        function () {
            addincidenciaid(
                $(this).data("programacion")
            );
        }
    );

    window.addincidenciaid = function (id) {
        var input = document.getElementById("id_programacion");

        if (input) {
            input.value = id;
        }
    };

    $("#send_incidencia").on(
        "click",
        function () {
            var input =document.getElementById("incidencia");

            if (!input) {
                return;
            }

            if (!input.value.trim()) {
                Swal.fire(
                    "Para continuar debes agregar la incidencia"
                );

                return;
            }

            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Espere un momento, la información está siendo procesada",
                showConfirmButton: false
            });

            var form =document.getElementById("submit_incidencia");

            if (form) {
                form.submit();
            }
        }
    );

    /* ======================================================================
       CAMBIO DE ESTATUS DESDE INFO PROESTATUS
       ====================================================================== */

    $("#btnupdatestatus").on(
        "click",
        function () {

            var form =document.getElementById("submit_estatus");
            var estatus =document.getElementById("estatus_id");

            if (!form || !estatus) {
                return;
            }

            if (!estatus.value) {
                Swal.fire("Selecciona un estatus para continuar.");
                return;
            }

            Swal.fire({
                title: "¿Cambiar estatus de programación?",
                text: "El nuevo estatus se guardará para este servicio.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, actualizar",
                cancelButtonText: "Cancelar",
                reverseButtons: true
            }).then(function (result) {

                if (!result.value) {
                    return;
                }

                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Espere un momento, la información está siendo procesada",
                    showConfirmButton: false
                });

                form.submit();
            });
        }
    );

    /* ======================================================================
       DATATABLES DE INFO PROESTATUS
       ====================================================================== */

    function iniciarTablaSiExiste(selector) {
        if (!$.fn.DataTable || !$(selector).length) {
            return;
        }

        if ($.fn.dataTable.isDataTable(selector)) {
            return;
        }

        $(selector).DataTable({
            pageLength: 10,
            lengthMenu: [10, 20, 50],
            ordering: true,
            autoWidth: false,
            language: {
                url: $("#datatable_i18n").val()
            },

            dom:
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'table-responsive'tr>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
        });
    }

    $(function () {
        MonitoreoListado.init();
        iniciarTablaSiExiste("#kdatatable_monitoreo_activo");
        iniciarTablaSiExiste("#kdatatable_incidenciass");
        iniciarTablaSiExiste("#kdatatable_observaciones");
    });

})(jQuery);