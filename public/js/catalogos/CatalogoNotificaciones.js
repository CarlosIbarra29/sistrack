$("#kdatatable_notificaciones").DataTable({
    language: {
        'lengthMenu': 'Display _MENU_',
        "url": $('#datatable_i18n').val()
    },

    "dom":
    "<'row'" +
    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
    ">" +

    "<'table-responsive'tr>" +

    "<'row'" +
    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
    ">"
});



$("#marcar_leido").click(function() {
    Swal.fire({
    title: "Estas seguro de marcar la notificación como leída? ",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Marcar!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true,
      confirmButtonColor: "#73ab17",
      cancelButtonColor: "#cc0c73",
  }).then(function(result) {
    if (result.value) {
      // document.getElementById("id_lic_act").value = id;
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Espere un momento, la información esta siendo procesada",
          showConfirmButton: false
      });
      document.getElementById("leido_notificacion").submit();
    } else if (result.dismiss === "cancel") {
      Swal.fire(
         "Cancelada",
        "La acción fue cancelada",
        "error"
      )
    }
  });
});
