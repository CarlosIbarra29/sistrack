@extends('layouts.app')
@push('scripts')
  {{-- <script src="{{ asset('js/custodios/EditarCustodio.js') }}"></script> --}}
@endpush
@section('title')
    Editar custodio
@endsection
@section('content')

<html>
<head>
    <!-- <base href="https://demos.telerik.com/kendo-ui/pdf-export/page-layout">
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; } --></style>
    <title></title>
   <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.1.223/styles/kendo.common.min.css" />
<!--      <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.1.223/styles/kendo.black.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2017.1.223/styles/kendo.black.mobile.min.css" /> -->

    <script src="https://kendo.cdn.telerik.com/2017.1.223/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2017.1.223/js/jszip.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2017.1.223/js/kendo.all.min.js"></script>
</head>
<body>
<div id="example">

<div class="row" style="margin-top: 10px;">
    <div class="col-lg-6">
        {{-- <a href="javascript:window.history.go(-1);" class="orange lighten-2 btn" style="color:black"><i class="material-icons left">arrow_back</i>Regresar</a>   --}}  
    </div>
    <div class="col-lg-6 text-right">
        <button class="export-pdf btn btn-primary mr-2" onclick="getPDF('.pdf-page')">Descargar</button>
    </div>
</div>

    <div class="page-container hidden-on-narrow">
        <div class="pdf-page size-a4">
            <div class="pdf-header">
              <div class="row">
                <div class="col-lg-3">
                    <span class="company-logo">
                        <img src="/img/logo_pdf.png" style="width: 90px;" />
                    </span>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="company-logo col-lg-12 text-center">
                            FICHA TÉCNICA
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="row">
                                <div class="col-lg-4">Fecha: 16/04/2021</div>

                                <div class="col-lg-4">Ver. 01</div>

                                <div class="col-lg-4">FT-CU-03</div>
                            </div>
                        </div>
                    </div>
                </div>  
              </div>
            </div>


{{--             <div class="pdf-footer">
                <p>Nte 31-A No. 96, col. Lindavista Vallejo III, Gustavo A. Madero, C.P. 07720, CDMX<br /></p>
            </div> --}}
            <div class="for" style="margin-top: 10px;">
              <div class="row">
              <div class="col-lg-6 text-center">
                <a class="example-image-link" href="/" data-lightbox="example-1"><img class="example-image oculto" src="{{ route('archivo.fotografiaCustodio', ['id'=>$custodio->id]) }}"  alt="image-1" style="width: 180px; height: 180px;"/></a> <br>
                {{-- <span>Fecha de ingreso: {{ date('d/m/Y', strtotime($custodio->fecha_nacimiento))}}</span> --}}
                  <table class="table responsive-table">
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">Fecha de ingreso</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>

                              <td>{{ date('d/m/Y', strtotime($custodio->fecha_nacimiento))}}</td>
                          </tr>
                      </tbody>
                  </table>

                  <table class="table responsive-table">
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">Fecha de actualización</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>

                              <td>{{ date('d/m/Y', strtotime($custodio->updated_at))}}</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
                <div class="col-lg-6">
                  <table class="table responsive-table" style="margin-left: 10px;">
                    <thead class="thead-light">
                      <tr>
                        <th></th>
                        <th></th>
                        <th scope="col">DATOS PERSONALES</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">Apellido Paterno</th>
                              <th scope="col">Apellido Materno</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Edad</th>
                              <th scope="col">Sexo</th>
                              <th scope="col">Fecha Nacimiento</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>{{ $custodio->ap_paterno }}</td>
                              <td>{{ $custodio->ap_materno }}</td>
                              <td>{{ $custodio->nombre_custodio }}</td>
                              <td>{{ $custodio->edad }}</td>
                              @if($custodio->sexo == 1)
                                <td>Masculino</td>
                              @endif
                              @if($custodio->sexo == 2)
                                <td>Femenino</td>
                              @endif
                              @if($custodio->sexo == 3)
                                <td>Otro</td>
                              @endif

                              <td>{{ date('d/m/Y', strtotime($custodio->fecha_nacimiento))}}</td>
                          </tr>
                      </tbody>
                  </table>

                  <table class="table" style="margin-left: 10px; width: 533px !important">
                      <thead class="thead-light">
                          <tr>
                              <th >Lugar de Nacimiento</th>
                              <th >Nacionalidad</th>
                              <th >Estado civil</th>
                              <th >RFC</th> 
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>{{ $custodio->lugar_nacimiento }}</td>
                              <td>{{ $custodio->nacionalidad }}</td>
                              <td>{{ $custodio->estado_civil }}</td>
                              <td>{{ $custodio->rfc }}</td>
                          </tr>
                      </tbody>
                  </table>

                  <table class="table responsive-table" style="margin-left: 10px;  width: 532px !important">
                      <thead class="thead-light">
                          <tr>
                            <th scope="col">CURP</th>
                              <th scope="col">Escolaridad</th>
                              <th scope="col">Teléfono</th>
                              <th scope="col">Correo Electrónico</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>{{ $custodio->curp }}</td>
                              <td>{{ $custodio->escolaridad }}</td>
                              <td>{{ $custodio->numero_telefono }}</td>
                              <td>{{ $custodio->correo_electronico }}</td>
                          </tr>
                      </tbody>
                  </table>


                </div>
              </div> 

              <div class="row">
                <div class="col-lg-12 text-center">
                  <table class="table responsive-table table-sm" style="width: 716px !important; margin-bottom: 1px !important;">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">DOMICILIO</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">Calle</th>
                              <th scope="col">Núm.Ext./Int.</th>
                              <th scope="col">Colonia</th>
                              <th scope="col">Municipio/Delegación</th>
                              <th scope="col">Estado</th>
                              <th scope="col">Código Postal</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>{{ $custodio->dom_calle }}</td>
                              <td>{{ $custodio->dom_num }}</td>
                              <td>{{ $custodio->dom_colonia }}</td>
                              <td>{{ $custodio->dom_municipio }}</td>
                              <td>{{ $custodio->dom_estado }}</td>
                              <td>{{ $custodio->dom_cp }}</td>
                          </tr>
                      </tbody>
                  </table>
                </div>   
              </div>

              <div class="row">
                <div class="col-lg-12 text-center">
                  <table class="table responsive-table table-sm" style="width: 716px !important">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">SELECCIÓN</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">Proceso</th>
                              <th scope="col">Fecha de aplicación</th>
                              <th scope="col">Comentarios</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>Entrevista Inicial</td>
                              @if($custodio_seleccion->entin_fecha != null || $custodio_seleccion->entin_fecha != "")
                                  <td>{{ date('d/m/Y', strtotime($custodio_seleccion->entin_fecha))}}</td>
                              @else 
                                <td></td>
                              @endif
                              <td>{{ $custodio_seleccion->entin_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Verificación Documental</td>
                              @if($custodio_seleccion->verdoc_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_seleccion->verdoc_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_seleccion->verdoc_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Entrevista Operativa / Seguridad </td>
                              @if($custodio_seleccion->entope_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_seleccion->entope_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_seleccion->entope_comentario }}</td>
                          </tr>
                      </tbody>
                  </table>
                </div>   
              </div>


              <div class="row">
                <div class="col-lg-12 text-center">
                  <table class="table responsive-table table-sm" style="width: 716px !important">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">CONTROL DE CONFIANZA</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">Proceso</th>
                              <th scope="col">Fecha de aplicación</th>
                              <th scope="col">Comentarios</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>Entrevista de Validación de Datos </td>
                              @if($custodio_confianza->valdat_fecha != null || $custodio_confianza->valdat_fecha != "")
                                  <td>{{ date('d/m/Y', strtotime($custodio_confianza->valdat_fecha))}}</td>
                              @else 
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->valdat_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Verificación de Referencias Personales</td>
                              @if($custodio_confianza->verref_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->verref_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->verref_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Verificación de Referencias Laborales</td>
                              @if($custodio_confianza->verlab_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->verlab_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->verlab_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Análisis Socioeconómico Laboral </td>
                              @if($custodio_confianza->anasoc_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->anasoc_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->anasoc_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Examen Físico </td>
                              @if($custodio_confianza->exafis_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->exafis_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->exafis_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Examen Médico</td>
                              @if($custodio_confianza->examed_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->examed_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->examed_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Examen Psicológico</td>
                              @if($custodio_confianza->exapsi_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->exapsi_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->exapsi_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Examen Toxicológico</td>
                              @if($custodio_confianza->exatox_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->exatox_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->exatox_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Test de Veracidad</td>
                              @if($custodio_confianza->tesver_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->tesver_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->tesver_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Test de Robo</td>
                              @if($custodio_confianza->tesrob_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->tesrob_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->tesrob_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Test de Normas </td>
                              @if($custodio_confianza->tesnor_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->tesnor_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->tesnor_comentario }}</td>
                          </tr>
                          <tr>
                              <td>Test de Soborno </td>
                              @if($custodio_confianza->tessob_fecha != null)
                                <td>{{ date('d/m/Y', strtotime($custodio_confianza->tessob_fecha))}}</td>
                              @else
                                <td></td>
                              @endif
                              <td>{{ $custodio_confianza->tessob_comentario }}</td>
                          </tr>

                      </tbody>
                  </table>
                </div>   
              </div>


            </div>

{{--             <div class="from" style="margin-top: 120px;">
                <div class="col-lg-12 text-right">
                    <a class="example-image-link" href="/" data-lightbox="example-1"><img class="example-image oculto" src="{{ route('archivo.fotografiaCustodio', ['id'=>$custodio->id]) }}"  alt="image-1" style="width: 150px; height: 150px;"/></a>
                </div>
            </div> --}}
            <div class="pdf-body" style="margin-top: 295px;">

                <div class="row">

     {{--              <div class="col m12 s12" style="margin-top: 145px;">
                        <table>
                            <thead>
                                <tr style="background-color: white;">
                                    <th><span class="title-pdf">Lista de dias trabajados</span></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    
                                </tr>
                            </tbody>
                        </table>
                  </div> --}}


                    <div class="col m12 s12">
{{--                         <table class="table text-left table-hover">
                            <thead>
                                <tr>
                                    <th>Sitio</th>
                                    <th>Asistencia</th>
                                    <th>Entrada</th>
                                    <th>Salida</th>
                                    <th>Información dia</th>
                                    <th>Pago</th>
                                    <th></th>
                                </tr> 
                            </thead>



                        </table> --}}
                    </div>
                    <div class="row" >
                        <div class="col m6 s6 text-center" style="margin-top: 50px;">
                            {{-- <span style="font-size:17px;">Pago de Nomina: </span> --}}
                            <span style="font-size:17px; color: green; letter-spacing: 0.1em; font-weight: bold;"></span>
                        </div>
                        <div class="col m6 s6 text-right" style="margin-top: 50px;">
{{--                             <span>_______________________________________</span><br>
                            <span style="font-size:13px; color: rgb(74,79,84); letter-spacing: 0.1em; font-weight: bold;"> Firma: </span> --}}
                        </div>
                    </div>

                </div>

                <div class="row">
                </div>

                <div class="row signature">
                    <div class="col m12 s12 text-center">
                        {{-- <img src="/img/logo-2.png" style="width: 150px;"><br> --}}
                        {{-- Aprobado: ING. Javier Morales Aguilera<br /><br /> --}}
                        
                    </div>
                </div>

<!--                 <p class="signature">
                    Signature: ________________ <br /><br />
                    Date: 12.03.2014
                </p> -->
            </div>
        </div>
    </div>


    
    <div class="responsive-message"></div>

    <style>
        /*
            Use the DejaVu Sans font for display and embedding in the PDF file.
            The standard PDF fonts have no support for Unicode characters.
        */
        .pdf-page {
            font-family: "DejaVu Sans", "Arial", sans-serif;
        }
    </style>

    <script>
        // Import DejaVu Sans font for embedding

        // NOTE: Only required if the Kendo UI stylesheets are loaded
        // from a different origin, e.g. cdn.kendostatic.com
        kendo.pdf.defineFont({
            "DejaVu Sans"             : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans.ttf",
            "DejaVu Sans|Bold"        : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Bold.ttf",
            "DejaVu Sans|Bold|Italic" : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf",
            "DejaVu Sans|Italic"      : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf"
        });
    </script>

    <!-- Load Pako ZLIB library to enable PDF compression -->
    <script src="../content/shared/js/pako.min.js"></script>

    <script>
      function getPDF(selector) {
        kendo.drawing.drawDOM($(selector)).then(function(group){
          kendo.drawing.pdf.saveAs(group, "Ficha tecnica .pdf");
        });
      }

    $(document).ready(function() {
        var data = [
          { productName: "QUESO CABRALES", unitPrice: 21, qty: 5 },
          { productName: "ALICE MUTTON", unitPrice: 39, qty: 7 },
          { productName: "GENEN SHOUYU", unitPrice: 15.50, qty: 3 },
          { productName: "CHARTREUSE VERTE", unitPrice: 18, qty: 1 },
          { productName: "MASCARPONE FABIOLI", unitPrice: 32, qty: 2 },
          { productName: "VALKOINEN SUKLAA", unitPrice: 16.25, qty: 3 }
        ];
        var schema = {
          model: {
            productName: { type: "string" },
            unitPrice: { type: "number", editable: false },
            qty: { type: "number" }
          },
          parse: function (data) {
                $.each(data, function(){
                    this.total = this.qty * this.unitPrice;
                });
                return data;
          }
        };
        var aggregate = [
          { field: "qty", aggregate: "sum" },
          { field: "total", aggregate: "sum" }
        ];
        var columns = [
          { field: "productName", title: "Product", footerTemplate: "Total"},
          { field: "unitPrice", title: "Price", width: 120},
          { field: "qty", title: "Pcs.", width: 120, aggregates: ["sum"], footerTemplate: "#=sum#" },
          { field: "total", title: "Total", width: 120, aggregates: ["sum"], footerTemplate: "#=sum#" }
        ];
        var grid = $("#grid").kendoGrid({
          editable: false,
          sortable: true,
          dataSource: {
            data: data,
            aggregate: aggregate,
            schema: schema,
          },
          columns: columns
        });

        $("#paper").kendoDropDownList({
          change: function() {
            $(".pdf-page")
              .removeClass("size-a4")
              .removeClass("size-letter")
              .removeClass("size-executive")
              .addClass(this.value());
          }
        });
    });
    </script>
    <style>

        .title-pdf{
            font-weight: bold;
            font-size: 13px;
        }
        .pdf-page {
            margin: 0 auto;
            box-sizing: border-box;
            box-shadow: 0 5px 10px 0 rgba(0,0,0,.3);
            background-color: #fff;
            color: #333;
            position: relative;
        }
        .pdf-header {
            position: absolute;
            top: .5in;
            height: .6in;
            left: .5in;
            right: .5in;
            /*border-bottom: 1px solid #e5e5e5;*/
        }
        .invoice-number {
            padding-top: .17in;
            float: right;
        }
        .pdf-footer {
            position: absolute;
            bottom: .5in;
            height: .6in;
            left: .5in;
            right: .5in;
            padding-top: 10px;
            border-top: 1px solid #e5e5e5;
            text-align: left;
            color: #787878;
            font-size: 12px;
        }
        .pdf-body {
            position: absolute;
            top: 2.9in;
            bottom: 1.2in;
            left: .5in;
            right: .5in;
        }

        .size-a4 { width: 8.3in; height: 11.7in; }
        .size-letter { width: 8.5in; height: 11in; }
        .size-executive { width: 7.25in; height: 10.5in; }

        .company-logo {
            font-size: 20px;
            font-weight: bold;
            color: #000;
        }
        .for {
            position: absolute;
            top: 1.5in;
            left: .5in;
            width: 3.5in;
        }
        .from {
            position: absolute;
            top: 1.5in;
            right: .5in;
            width: 3.5in;
        }
        .from p, .for p {
            color: #787878;
        }
        .signature {
            padding-top: .1in;
        }

        .text-table{
            font-size: 12px;
        }

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 0px 10px;

    </style>

</div>


</body>



@endsection


