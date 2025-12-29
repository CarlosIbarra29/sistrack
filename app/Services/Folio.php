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


    public function getFolioCliente(){

        $folio = ClienteFolio::latest('id')->first();
        // dd($folio);
        
         
        $folioModel = new ClienteFolio();
        $folioModel->folio = $folio;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "CL".str_pad($folio,4,"0", STR_PAD_LEFT);

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
        $folio = $folio->folio ? ++$folio->folio : 1;
         
        $folioModel = new TarifarioFolio();
        $folioModel->folio = $folio;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "U".str_pad($folio,4,"0", STR_PAD_LEFT);

    }

}
