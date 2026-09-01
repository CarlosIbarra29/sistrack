"use strict";

/* ==========================================================================
   SISTRACK - INFO PROESTATUS
   MAPA DE ORIGEN / DESTINO
   ========================================================================== */

(function () {

    var map = null;
    var mapElement = null;

    document.addEventListener(
        "DOMContentLoaded",
        function () {
            initMapaServicio();
            initFullscreen();
        }
    );

    /* ======================================================================
       INICIALIZACIÓN
       ====================================================================== */

    async function initMapaServicio() {

        mapElement =document.getElementById("map-monitoring");

        if (!mapElement ||  typeof L === "undefined") {
            return;
        }

        var origen =(mapElement.dataset.origen || "").trim();
        var destino =(mapElement.dataset.destino || "").trim();

        map = L.map("map-monitoring",
            {
                zoomControl: true,
                attributionControl: true
            }
        ).setView(
            [23.6345, -102.5528],
            5
        );

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            {
                maxZoom: 19,
                attribution:
                    "&copy; OpenStreetMap contributors"
            }
        ).addTo(map);

        if (!origen && !destino) {
            mostrarEstado("Sin ubicaciones registradas","error");
            mostrarDistancia("No hay información suficiente para calcular la ruta.");

            return;
        }

        mostrarEstado(
            "Localizando origen y destino..."
        );

        try {

            var resultados =
                await Promise.all([
                    geocodificar(origen),
                    geocodificar(destino)
                ]);

            var origenCoords = resultados[0];
            var destinoCoords =resultados[1];

            pintarMapa(origen,origenCoords,destino,destinoCoords);

        } catch (error) {

            console.error("Error al cargar las ubicaciones:",error);
            mostrarEstado( "No fue posible localizar la ruta","error");
            mostrarDistancia("No se pudo calcular la distancia aproximada.");
        }
    }

    /* ======================================================================
       GEOCODIFICACIÓN
       ====================================================================== */

    async function geocodificar(direccion) {

        if (!direccion) {
            return null;
        }

        var consulta =direccion + ", México";

        var url =
            "https://nominatim.openstreetmap.org/search" +
            "?format=jsonv2" +
            "&limit=1" +
            "&countrycodes=mx" +
            "&accept-language=es" +
            "&q=" +
            encodeURIComponent(consulta);

        var response =
            await fetch(
                url,
                {
                    method: "GET",
                    headers: {
                        "Accept":
                            "application/json"
                    }
                }
            );

        if (!response.ok) {
            throw new Error(
                "Error de geocodificación"
            );
        }

        var datos =
            await response.json();

        if (!datos.length) {
            return null;
        }

        return {
            lat:parseFloat( datos[0].lat),
            lng:parseFloat(datos[0].lon),
            nombre:datos[0].display_name
        };
    }

    /* ======================================================================
       DIBUJAR RESULTADOS
       ====================================================================== */

    function pintarMapa(origenTexto,origen,destinoTexto,destino) {

        var puntos = [];

        if (origen) {

            var origenMarker =
                L.circleMarker(
                    [origen.lat, origen.lng],
                    {
                        radius: 8,
                        color: "#20c997",
                        fillColor: "#20c997",
                        fillOpacity: 1,
                        weight: 3
                    }
                ).addTo(map);

            origenMarker.bindPopup(
                crearPopup(
                    "Origen",
                    origenTexto,
                    origen.nombre
                )
            );

            puntos.push(
                [origen.lat, origen.lng]
            );
        }

        if (destino) {

            var destinoMarker =
                L.circleMarker(
                    [destino.lat, destino.lng],
                    {
                        radius: 8,
                        color: "#ef535b",
                        fillColor: "#ef535b",
                        fillOpacity: 1,
                        weight: 3
                    }
                ).addTo(map);

            destinoMarker.bindPopup(
                crearPopup(
                    "Destino",
                    destinoTexto,
                    destino.nombre
                )
            );

            puntos.push(
                [destino.lat, destino.lng]
            );
        }

        if (
            origen &&
            destino
        ) {

            L.polyline(
                [
                    [origen.lat, origen.lng],
                    [destino.lat, destino.lng]
                ],
                {
                    color: "#eba72f",
                    weight: 4,
                    opacity: 0.8,
                    dashArray: "8, 8"
                }
            ).addTo(map);

            var distancia =calcularDistancia( origen.lat,origen.lng,destino.lat,destino.lng);

            mostrarDistancia("Distancia lineal aproximada: " + distancia.toFixed(1) + " km" );
            mostrarEstado( "Origen y destino localizados", "success");

        } else if (origen || destino) {

            mostrarDistancia("Solo se pudo localizar uno de los dos puntos.");
            mostrarEstado( "Ubicación parcial","warning");

        } else {

            mostrarDistancia("No se pudieron localizar las direcciones registradas.");
            mostrarEstado("Direcciones no localizadas","error");
        }

        if (puntos.length === 1) {

            map.setView(
                puntos[0],
                12
            );

        } else if (puntos.length > 1) {

            map.fitBounds(
                L.latLngBounds(puntos),
                {
                    padding: [45, 45]
                }
            );
        }

        setTimeout(
            function () {
                map.invalidateSize();
            },
            150
        );
    }

    /* ======================================================================
       POPUPS
       ====================================================================== */

    function crearPopup(titulo,direccion,referencia) {

        var div =document.createElement("div" );
        div.className ="monitoreo-map-popup";

        var encabezado =document.createElement("strong");
        encabezado.textContent =titulo;

        var direccionElemento =document.createElement("span");
        direccionElemento.textContent =direccion;

        var referenciaElemento = document.createElement("small");
        referenciaElemento.textContent =referencia;

        div.appendChild( encabezado);
        div.appendChild(direccionElemento );
        div.appendChild(referenciaElemento);

        return div;
    }

    /* ======================================================================
       DISTANCIA HAVERSINE
       ====================================================================== */

    function calcularDistancia(
        lat1,
        lon1,
        lat2,
        lon2
    ) {

        var radioTierra =
            6371;

        var dLat =
            gradosARadianes(
                lat2 - lat1
            );

        var dLon =
            gradosARadianes(
                lon2 - lon1
            );

        var a =
            Math.sin(dLat / 2) *
            Math.sin(dLat / 2) +
            Math.cos(
                gradosARadianes(lat1)
            ) *
            Math.cos(
                gradosARadianes(lat2)
            ) *
            Math.sin(dLon / 2) *
            Math.sin(dLon / 2);

        var c =
            2 *
            Math.atan2(
                Math.sqrt(a),
                Math.sqrt(1 - a)
            );

        return radioTierra * c;
    }

    function gradosARadianes(valor) {
        return valor * Math.PI / 180;
    }

    /* ======================================================================
       ESTADO VISUAL
       ====================================================================== */

    function mostrarEstado(
        texto,
        tipo
    ) {

        var elemento =
            document.getElementById(
                "map-status"
            );

        if (!elemento) {
            return;
        }

        elemento.classList.remove(
            "is-success",
            "is-warning",
            "is-error"
        );

        if (tipo) {
            elemento.classList.add(
                "is-" + tipo
            );
        }

        elemento.innerHTML =
            '<span class="monitoreo-live-dot"></span>' +
            escaparHtml(texto);
    }

    function mostrarDistancia(texto) {

        var elemento =
            document.getElementById(
                "map-distance"
            );

        if (elemento) {
            elemento.textContent =
                texto;
        }
    }

    /* ======================================================================
       FULLSCREEN
       ====================================================================== */

    function initFullscreen() {

        var boton =
            document.getElementById(
                "btnMapFullscreen"
            );

        var container =
            document.getElementById(
                "map-container-fullscreen"
            );

        if (
            !boton ||
            !container
        ) {
            return;
        }

        boton.addEventListener(
            "click",
            function () {

                if (
                    !document.fullscreenElement
                ) {

                    if (
                        container.requestFullscreen
                    ) {
                        container.requestFullscreen();
                    }

                } else if (
                    document.exitFullscreen
                ) {

                    document.exitFullscreen();
                }
            }
        );

        document.addEventListener(
            "fullscreenchange",
            function () {

                setTimeout(
                    function () {

                        if (map) {
                            map.invalidateSize();
                        }

                    },
                    250
                );
            }
        );
    }

    /* ======================================================================
       SEGURIDAD HTML
       ====================================================================== */

    function escaparHtml(texto) {

        return String(texto || "")
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

})();