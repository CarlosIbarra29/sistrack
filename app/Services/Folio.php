<?php


namespace App\Services;


use App\Models\Programacion\FolioProgramacion;
use App\Models\Cliente\ClienteFolio;
use App\Models\Custodio\CustodioFolio;
use App\Models\Usuarios\UsuarioFolio;
use App\Models\Tarifario\TarifarioFolio;

class Folio
{
    public function __construct()
    {

    }

    public function getFolioProgramacion(){

        $folio = FolioProgramacion::latest('id')->first();
        $folio = $folio->folio ? ++$folio->folio : 1;
        $folioModel = new FolioProgramacion();
        $folioModel->folio = $folio;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "SISP-".str_pad($folio,5,"0", STR_PAD_LEFT);

    }


    public function getFolioCliente()
{
    $ultimo = ClienteFolio::latest('id')->first();

    $numero = $ultimo ? ((int)$ultimo->folio + 1) : 1;

    $folioFormateado = 'CL' . str_pad($numero, 4, '0', STR_PAD_LEFT);

    $folioModel = new ClienteFolio();
    $folioModel->folio = $numero; // 👈 SOLO EL NÚMERO
    $folioModel->anio = date('Y');
    $folioModel->save();

    return $folioFormateado;
}

    public function getFolioCustodio(){

        $folio = CustodioFolio::latest('id')->first();
        
        $folio = $folio->folio ? ++$folio->folio : 1;

        $folioModel = new CustodioFolio();
        $folioModel->folio = $folio;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "C".str_pad($folio,4,"0", STR_PAD_LEFT);

    }

    public function getFolioUsuario(){

        $folio = UsuarioFolio::latest('id')->first();
        // dd($folio);
        $folio = $folio->folio ? ++$folio->folio : 1;
         
        $folioModel = new UsuarioFolio();
        $folioModel->folio = $folio;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "U".str_pad($folio,4,"0", STR_PAD_LEFT);

    }

    public function getFolioTarifario(){

        $folio = TarifarioFolio::latest('id')->first();
        // dd($folio);
        $folioRegistro = TarifarioFolio::latest('id')->first();

      $folio = $folioRegistro ? $folioRegistro->folio + 1 : 1;

         
        $folioModel = new TarifarioFolio();
        $folioModel->folio = $folio;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "U".str_pad($folio,4,"0", STR_PAD_LEFT);

    }

}
