<?php


namespace App\Services;


use App\Models\Programacion\FolioProgramacion;

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



}
