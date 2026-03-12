

const x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success, error);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function success(position) {
  // x.innerHTML = "Latitude: " + position.coords.latitude + 
  // "<br>Longitude: " + position.coords.longitude;

  console.log(position.coords.latitude);
  console.log(position.coords.longitude);
  // console.log();

    var imagen = document.getElementById("file_carga").value;
    if(imagen == null || imagen == "")
    {
        Swal.fire("Para continuar debes agregar una imagen");
    }else{
        latitude = document.getElementById("latitude").value= position.coords.latitude;
        longitude = document.getElementById("longitude").value= position.coords.longitude;

        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Espere un momento, la información esta siendo procesada",
            showConfirmButton: false
        });
        document.getElementById("submit_evidencia_bitacora").submit();
        
    }

}

function error() {

    var imagen = document.getElementById("file_carga").value;
    if(imagen == null || imagen == "")
    {
        Swal.fire("Para continuar debes agregar una imagen");
    }else{
        latitude = document.getElementById("latitude").value= 19.484298;
        longitude = document.getElementById("longitude").value= -99.156401;

        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Espere un momento, la información esta siendo procesada",
            showConfirmButton: false
        });
        document.getElementById("submit_evidencia_bitacora").submit();

    }

  // alert("Lo siento, la ubicacion de su navegador no esta disponible.");
}




$("#bitacora_info").DataTable({
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


$("#en_camino_punto_origen").click(function(){

  Swal.fire({
    title: "Estas seguro de cambiar el estatus a En punto de origen?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Cambiarlo!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true,
      confirmButtonColor: "#73ab17",
      cancelButtonColor: "#cc0c73",
  }).then(function(result) {
    if (result.value) {
      // document.getElementById("id_delete").value = id;
      document.getElementById("op_estatus").value= 1;
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Espere un momento, la información esta siendo procesada",
          showConfirmButton: false
      });
      document.getElementById("cambio_estatus").submit();
    } else if (result.dismiss === "cancel") {
      Swal.fire(
         "Cancelada",
        "La acción fue cancelada",
        "error"
      )
    }
  });
});


$("#en_punto_origen_op_uno").click(function(){

  Swal.fire({
    title: "Estas seguro de cambiar el estatus a En camino a punto de origen?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Cambiarlo!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true,
      confirmButtonColor: "#73ab17",
      cancelButtonColor: "#cc0c73",
  }).then(function(result) {
    if (result.value) {
      // document.getElementById("id_delete").value = id;
      document.getElementById("op_estatus").value= 2;
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Espere un momento, la información esta siendo procesada",
          showConfirmButton: false
      });
      document.getElementById("cambio_estatus").submit();
    } else if (result.dismiss === "cancel") {
      Swal.fire(
         "Cancelada",
        "La acción fue cancelada",
        "error"
      )
    }
  });
});

$("#en_punto_origen_op_dos").click(function(){

  Swal.fire({
    title: "Estas seguro de cambiar el estatus a En viaje?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Cambiarlo!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true,
      confirmButtonColor: "#73ab17",
      cancelButtonColor: "#cc0c73",
  }).then(function(result) {
    if (result.value) {
      // document.getElementById("id_delete").value = id;
      document.getElementById("op_estatus").value= 1;
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Espere un momento, la información esta siendo procesada",
          showConfirmButton: false
      });
      document.getElementById("cambio_estatus").submit();
    } else if (result.dismiss === "cancel") {
      Swal.fire(
         "Cancelada",
        "La acción fue cancelada",
        "error"
      )
    }
  });
});



$("#en_viaje_op_uno").click(function(){

  Swal.fire({
    title: "Estas seguro de cambiar el estatus a En punto de origen?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Cambiarlo!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true,
      confirmButtonColor: "#73ab17",
      cancelButtonColor: "#cc0c73",
  }).then(function(result) {
    if (result.value) {
      // document.getElementById("id_delete").value = id;
      document.getElementById("op_estatus").value= 2;
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Espere un momento, la información esta siendo procesada",
          showConfirmButton: false
      });
      document.getElementById("cambio_estatus").submit();
    } else if (result.dismiss === "cancel") {
      Swal.fire(
         "Cancelada",
        "La acción fue cancelada",
        "error"
      )
    }
  });
});

$("#en_viaje_op_dos").click(function(){

  Swal.fire({
    title: "Estas seguro de cambiar el estatus a En punto de destino?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Cambiarlo!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true,
      confirmButtonColor: "#73ab17",
      cancelButtonColor: "#cc0c73",
  }).then(function(result) {
    if (result.value) {
      // document.getElementById("id_delete").value = id;
      document.getElementById("op_estatus").value= 1;
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Espere un momento, la información esta siendo procesada",
          showConfirmButton: false
      });
      document.getElementById("cambio_estatus").submit();
    } else if (result.dismiss === "cancel") {
      Swal.fire(
         "Cancelada",
        "La acción fue cancelada",
        "error"
      )
    }
  });
});



$("#en_punto_destino_op_uno").click(function(){

  Swal.fire({
    title: "Estas seguro de cambiar el estatus a En viaje?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, Cambiarlo!",
    cancelButtonText: "No, Cancelar!",
    reverseButtons: true,
      confirmButtonColor: "#73ab17",
      cancelButtonColor: "#cc0c73",
  }).then(function(result) {
    if (result.value) {
      // document.getElementById("id_delete").value = id;
      document.getElementById("op_estatus").value= 2;
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Espere un momento, la información esta siendo procesada",
          showConfirmButton: false
      });
      document.getElementById("cambio_estatus").submit();
    } else if (result.dismiss === "cancel") {
      Swal.fire(
         "Cancelada",
        "La acción fue cancelada",
        "error"
      )
    }
  });
});