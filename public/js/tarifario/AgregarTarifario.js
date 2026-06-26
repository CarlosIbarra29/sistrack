"use strict";
var Modulo = function() {

    var lista = ''; //lista de elementos
    var contadorDocumentos=0; //indice contador de elementos
    var validador; //validador del formulario
    var contadorDoc=0; //indice contador de elementos

    var validacion = function() {
        //validacion de formulario
        const form = document.getElementById('submit_cliente');
        validador = FormValidation.formValidation(
            form,
            {
                locale: 'es_ES',
                localization: FormValidation.locales.es_ES,
                fields: {

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    declarative: new FormValidation.plugins.Declarative({
                        html5Input: true,
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //  eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
                        //  eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
                    })
                }
            }
        ).on('core.form.valid', function() {
            toastr.success("Guardando, Por favor Espere...");
        }).on('core.form.invalid', function() {
            toastr.warning("Por favor, Ingrese la información marcada en rojo.");
            KTUtil.scrollTop();
        });

        $( "#btnGuardar" ).click(function( e ) {
            e.preventDefault();
            validador.validate().then(function(status) {
                if (status === 'Valid'){
                    var btnGuardar = document.getElementById('btnGuardar');
                    KTUtil.btnWait( btnGuardar, 'spinner spinner-right spinner-white pr-15', 'Espere...', true);
                    form.submit();
                }
            });
        });
    };

    var initEvents = function() {

        var arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }

        $("#costo_estadia").inputmask('$ 999,999,999.99', {
            numericInput: true
        });

        $("#costo_km").inputmask('$ 999,999,999.99', {
            numericInput: true
        });


        $("#cliente_id").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });


    };



    var eventosEspeciales = function () {
        $('#elemento1').val();
    };

    return {

        //main function to initiate the module
        init: function() {
            initEvents();
            validacion();
            eventosEspeciales();
        },

    };

}();

jQuery(document).ready(function() {
    Modulo.init();
});


    const formatoMexico = (number) => {
        const exp = /(\d)(?=(\d{3})+(?!\d))/g;
        const rep = '$1,';
        let arr = number.toString().split('.');
        arr[0] = arr[0].replace(exp,rep);
        return arr[1] ? arr.join('.'): arr[0];
    }

// function onclickkms(e) {
//     var kms = e.value;
//     var ppkm_sis = document.getElementById("ppkm_sis").value;
//     var ppkm_cust = document.getElementById("ppkm_cust").value;

//     var total_sis = kms * ppkm_sis;
//     var total_cliente = document.getElementById("monto_cliente").value = total_sis; //total cliente

//     var total_cust = kms * ppkm_cust;
//     document.getElementById("monto_custodio").value = total_cust; //total custodio

//     var total_custodio = document.getElementById("monto_custodio").value;
//     var caseta = document.getElementById("caseta").value;
//     var subtotal = parseInt(caseta) + parseInt(total_custodio);
 
//     document.getElementById("subtotal_sis").value = subtotal; // subtotal

//     var ganancia_total = parseInt(total_cliente) - parseInt(total_custodio) - parseInt(caseta);
//     document.getElementById("ganancia_total").value = ganancia; // Ganancia
// }


// function onclickppkmsis(e) {
//     var ppkm_sis = e.value;
//     var kms = document.getElementById("kms").value;

//     var total_sis = kms * ppkm_sis;
//     document.getElementById("monto_cliente").value = total_sis; 

//     var ppkm_cust = document.getElementById("ppkm_cust").value;
//     var total_cust = kms * ppkm_cust;
//     document.getElementById("monto_custodio").value = total_cust; //total custodio

//     var total_custodio = document.getElementById("monto_custodio").value;
//     var caseta = document.getElementById("caseta").value;
//     var subtotal = parseInt(caseta) + parseInt(total_custodio);
 
//     document.getElementById("subtotal_sis").value = subtotal; // subtotal

//     var ganancia_total = parseInt(total_cliente) - parseInt(total_custodio) - parseInt(caseta);
//     document.getElementById("ganancia_total").value = ganancia; // Ganancia

// }

// function onclickppkmcust(e) {
//     var ppkm_cust = e.value;
//     var kms = document.getElementById("kms").value;

//     var total_cust = kms * ppkm_cust;
//     document.getElementById("monto_custodio").value = total_cust;
//     var caseta = document.getElementById("caseta").value;
//     var subtotal = caseta + total_cust;

//     document.getElementById("subtotal_sis").value = subtotal;

// }

// function onclickcaseta(e) {
//     var caseta = e.value;
    
//     var custodio = document.getElementById("monto_custodio").value;
//     var subtotal_monto = caseta+custodio;
//     console.log(subtotal_monto);
//     document.getElementById("subtotal_sis").value = subtotal_monto;
// }


$("#calcular_tarifa").click(function(){
    var kms = document.getElementById("kms").value;
    var ppkm_sis = document.getElementById("ppkm_sis").value;
    var ppkm_cust = document.getElementById("ppkm_cust").value;
    var caseta = document.getElementById("caseta").value;
    var apoyos = document.getElementById("monto_apoyos").value;
    var estadias = document.getElementById("estadias").value;
    var acompanantes = document.getElementById("acompanantes").value;
     var Estadías Custodio = document.getElementById("Estadías Custodio").value;
    var Estadías Clientes = document.getElementById("Estadías Clientes").value;
    var Horas de Estadia = document.getElementById("Horas de Estadia").value;
    var SIS pago custodio II = document.getElementById("SIS pago custodio II").value;
    var SIS pago custodio III = document.getElementById("SIS pago custodio III").value;
    var Pago de custodio segundo = document.getElementById("Pago de custodio segundo").value;
    var Pago de custodio tercero = document.getElementById("Pago de custodio tercero").value;

    var total_sis = kms * ppkm_sis;
    var total_cliente = document.getElementById("monto_cliente").value = formatoMexico(total_sis.toFixed(2)); //total cliente
            
    var total_apoyo = document.getElementById("resumen_apoyos").value = formatoMexico(parseFloat(apoyos).toFixed(2)); //apoyos

    var total_estadias = document.getElementById("resumen_estadias").value = formatoMexico(parseFloat(estadias).toFixed(2)); //estadias
    
    var total_cust = kms * ppkm_cust;
    document.getElementById("monto_custodio").value = formatoMexico(total_cust.toFixed(2)); //total custodio

    // var subtotal = parseInt(caseta) + parseInt(total_cust) //Antes

    var suma_extras = parseInt(total_apoyo) + parseInt(total_estadias) + parseInt(acompanantes);

    var subtotal = parseInt(caseta) + parseInt(total_cust) + parseInt(suma_extras);

    document.getElementById("subtotal_sis").value = formatoMexico(subtotal.toFixed(2)); //subtotal

    var ganancia = parseInt(total_sis) - parseInt(total_cust) - parseInt(caseta) - parseInt(suma_extras);

    document.getElementById("ganancia").value = formatoMexico(ganancia.toFixed(2)); //ganancia

    

    var porcentaje_custodio_suma = (parseInt(caseta) + parseInt(total_cust) + parseInt(suma_extras)) * 100;
    var porcentaje_custodio = porcentaje_custodio_suma / parseInt(total_sis);
    
    document.getElementById("porcentaje_custodio").value = formatoMexico(porcentaje_custodio.toFixed(2)); //porcentaje custodio

    var porcentaje_sisprotec = 100 - porcentaje_custodio;
    console.log("porcentaje custodio: " + parseInt(porcentaje_sisprotec));
    document.getElementById("porcentaje_sisprotec").value = formatoMexico(porcentaje_sisprotec.toFixed(2)); //porcentaje sisprotec

    document.getElementById("total").value = 100; //porcentaje sisprotec
});