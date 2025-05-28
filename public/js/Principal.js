"use strict";
var Principal = (function () {
    var routeName = $("#routeName").val();

    var showTititleWhenScroll = function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $("#scroll_title").fadeIn();
            } else {
                $("#scroll_title").fadeOut();
            }
        });
    };

    var sidebarToggleActiveMenu = function () {
        //tablero
        if (routeName != "tablero.show") {
            $("#menuHome").removeClass("menu-item-active");
        }


        //activar menu de Administracion
        function activeMenuAdministracion() {
            $("#menuAdministracion").addClass("menu-item-active");
            $("#menuAdministracion").addClass("menu-item-open");
        }

        //rutas para el menu de usuarios
        if (routeName.includes("user")) {
            activeMenuAdministracion();
            //we addd the active class to the menuUsuarios parent item
            $("#menuUsuarios").addClass("menu-item-active");
            $("#menuUsuarios").addClass("menu-item-open");

            switch (routeName) {
                case "user.catalogousuarios":
                    //we add the class 'menu-item-open' to id menuListadoUsuarios
                    $("#menuListadoUsuarios").addClass("menu-item-open");
                    break;
                case "user.agregarusuario":
                    $("#menuNuevoUsuario").addClass("menu-item-open");
                    break;
            }
        }

        if (routeName.includes("rol")) {
            activeMenuAdministracion();
            $("#menuRoles").addClass("menu-item-active");
            $("#menuRoles").addClass("menu-item-open");
            switch (routeName) {
                case "rol.catalogoroles":
                    $("#menuListadoRoles").addClass("menu-item-open");
                    break;
                case "rol.agregarrol":
                    $("#menuNuevoRol").addClass("menu-item-open");
                    break;
            }
        }

        //activar menu de SERVICIOS
        function activeMenuServicios() {
            $("#menuServicios").addClass("menu-item-active");
            $("#menuServicios").addClass("menu-item-open");
        }

        //rutas para el menu de clientes
        if (routeName.includes("cliente")) {
            activeMenuServicios();
            //we addd the active class to the menuUsuarios parent item
            $("#menuClientes").addClass("menu-item-active");
            $("#menuClientes").addClass("menu-item-open");

            switch (routeName) {
                case "cliente.listadocliente":
                    //we add the class 'menu-item-open' to id menuListadoUsuarios
                    $("#menuListadoClientes").addClass("menu-item-open");
                    break;
                case "cliente.agregarcliente":
                    $("#menuNuevoUsuario").addClass("menu-item-open");
                    break;
            }
        }


        //rutas para el menu de clientes
        if (routeName.includes("tarifario")) {
            activeMenuServicios();
            //we addd the active class to the menuUsuarios parent item
            $("#menuTarifario").addClass("menu-item-active");
            $("#menuTarifario").addClass("menu-item-open");

            switch (routeName) {
                case "tarifario.listadotarifario":
                    //we add the class 'menu-item-open' to id menuListadoUsuarios
                    $("#menuListadoTarifario").addClass("menu-item-open");
                    break;
            }
        }


        //activar menu de CUSTODIOS
        function activeMenuCustodios() {
            $("#menuCustodios").addClass("menu-item-active");
            $("#menuCustodios").addClass("menu-item-open");
        }

        //rutas para el menu de clientes
        if (routeName.includes("custodio")) {
            activeMenuCustodios();
            //we addd the active class to the menuUsuarios parent item
            $("#menuRegistroCustodios").addClass("menu-item-active");
            $("#menuRegistroCustodios").addClass("menu-item-open");

            switch (routeName) {
                case "custodio.listadocustodio":
                    //we add the class 'menu-item-open' to id menuListadoUsuarios
                    $("#menuListadoCustodios").addClass("menu-item-open");
                    break;
                case "cliente.agregarcliente":
                    $("#menuNuevoUsuario").addClass("menu-item-open");
                    break;
            }
        }


        //activar menu de Programacion
        function activeMenuProgramacion() {
            $("#menuProgramacion").addClass("menu-item-active");
            $("#menuProgramacion").addClass("menu-item-open");
        }

        //rutas para el menu de clientes
        if (routeName.includes("programacion")) {
            activeMenuProgramacion();
            //we addd the active class to the menuUsuarios parent item
            $("#menuRegistroProgramacion").addClass("menu-item-active");
            $("#menuRegistroProgramacion").addClass("menu-item-open");

            switch (routeName) {
                case "programacion.listadoprogramacion":
                    //we add the class 'menu-item-open' to id menuListadoUsuarios
                    $("#menuListadoProgramacion").addClass("menu-item-open");
                    break;

            }
        }


        //activar menu de Monitoreo
        function activeMenuMonitoreo() {
            $("#menuMonitoreo").addClass("menu-item-active");
            $("#menuMonitoreo").addClass("menu-item-open");
        }

        //rutas para el menu de clientes
        if (routeName.includes("monitoreo")) {
            activeMenuMonitoreo();
            //we addd the active class to the menuUsuarios parent item
            $("#menuRegistroMonitoreo").addClass("menu-item-active");
            $("#menuRegistroMonitoreo").addClass("menu-item-open");

            switch (routeName) {
                case "monitoreo.listamonitoreo":
                    //we add the class 'menu-item-open' to id menuListadoUsuarios
                    $("#menuListadoMonitoreo").addClass("menu-item-open");
                    break;

            }
        }



        //activar menu de CATALOGOS
        function activeMenuCatalogos() {
            $("#menuCatalogos").addClass("menu-item-active");
            $("#menuCatalogos").addClass("menu-item-open");
        }

        //rutas para el menu de clientes
        if (routeName.includes("area")) {
            activeMenuCatalogos();
            //we addd the active class to the menuUsuarios parent item
            $("#menuCatalogoArePersonal").addClass("menu-item-active");
            $("#menuCatalogoArePersonal").addClass("menu-item-open");

            switch (routeName) {
                case "area.listadoarea":
                    //we add the class 'menu-item-open' to id menuListadoUsuarios
                    $("#menuListadoareapersonal").addClass("menu-item-open");
                    break;
            }
        }

        //rutas para el menu de clientes
        if (routeName.includes("doccustodio")) {
            activeMenuCatalogos();
            //we addd the active class to the menuUsuarios parent item
            $("#menuCatalogoDocumentacionCustodio").addClass("menu-item-active");
            $("#menuCatalogoDocumentacionCustodio").addClass("menu-item-open");

            switch (routeName) {
                case "doccustodio.listadodoccustodio":
                    //we add the class 'menu-item-open' to id menuListadoUsuarios
                    $("#menuListadodoccustodio").addClass("menu-item-open");
                    break;
            }
        }

        //rutas para el menu de clientes
        if (routeName.includes("docvehiculo")) {
            activeMenuCatalogos();
            //we addd the active class to the menuUsuarios parent item
            $("#menuCatalogoDocumentacionVehiculo").addClass("menu-item-active");
            $("#menuCatalogoDocumentacionVehiculo").addClass("menu-item-open");

            switch (routeName) {
                case "docvehiculo.listadodocvehiculo":
                    //we add the class 'menu-item-open' to id menuListadoUsuarios
                    $("#menuListadodocvehiculo").addClass("menu-item-open");
                    break;
            }
        }


    };

    return {
        //main function to initiate the module
        init: function () {
            sidebarToggleActiveMenu();
            showTititleWhenScroll();
        },
    };
})();

jQuery(document).ready(function () {
    Principal.init();
});
