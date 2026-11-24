$("#btnGuardar").click(function(){
    var id = $(this).data('id');
    var nombre = $(this).data('nombre');

    Swal.fire({
      title: "Estas seguro de guardar la información",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, Guardar!",
      cancelButtonText: "No, Cancelar!",
      reverseButtons: true,
      confirmButtonColor: "#73ab17",
      cancelButtonColor: "#cc0c73",
    }).then(function(result) {
      if (result.value) {
        // document.getElementById("id_metodopago_act").value = id;
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Espere un momento, la información esta siendo procesada",
          showConfirmButton: false
        });
        document.getElementById("submit_add_control").submit();
      } else if (result.dismiss === "cancel") {
        Swal.fire(
          "Cancelada",
          "La acción fue cancelada",
          "error"
        )
      }
    });
});

$("#btnEdit").click(function(){
    var id = $(this).data('id');
    var nombre = $(this).data('nombre');

    Swal.fire({
      title: "Estas seguro de guardar la información",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, Editar!",
      cancelButtonText: "No, Cancelar!",
      reverseButtons: true,
      confirmButtonColor: "#73ab17",
      cancelButtonColor: "#cc0c73",
    }).then(function(result) {
      if (result.value) {
        // document.getElementById("submit_edit_control").value = id;
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Espere un momento, la información esta siendo procesada",
          showConfirmButton: false
        });
        document.getElementById("submit_edit_control").submit();
      } else if (result.dismiss === "cancel") {
        Swal.fire(
          "Cancelada",
          "La acción fue cancelada",
          "error"
        )
      }
    });
});