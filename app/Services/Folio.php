<?php


namespace App\Services;


use App\Models\Programacion\FolioProgramacion;
use App\Models\Cliente\ClienteFolio;
use App\Models\Custodio\CustodioFolio;

class Folio
{
    public function __construct()
    {

    }

    public function getFolioProgramacion(){

        $folio = FolioProgramacion::with('folio')->max('folio');
        $folio = $folio ? ++$folio : 1;
        $folioModel = new FolioProgramacion();
        $folioModel->folio = $folio;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "SISP-".str_pad($folio,5,"0", STR_PAD_LEFT);

    }


    public function getFolioCliente(){

        $folio = ClienteFolio::with('folio')->max('folio');
        // dd($folio);
        $folio = $folio ? ++$folio : 1;
         
        $folioModel = new ClienteFolio();
        $folioModel->folio = $folio;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "CL".str_pad($folio,5,"0", STR_PAD_LEFT);

    }

    public function getFolioCustodio(){

        $folio = ClienteFolio::with('folio')->max('folio');
        // dd($folio);
        $folio = $folio ? ++$folio : 1;
         
        $folioModel = new ClienteFolio();
        $folioModel->folio = $folio;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "C".str_pad($folio,5,"0", STR_PAD_LEFT);

    }

}
