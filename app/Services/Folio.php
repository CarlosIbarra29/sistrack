<?php

namespace App\Services;

use App\Models\Programacion\FolioProgramacion;
use App\Models\Cliente\ClienteFolio;
use App\Models\Custodio\CustodioFolio;
use App\Models\Usuarios\UsuarioFolio;
use App\Models\Tarifario\TarifarioFolio;

class Folio
{
    public function __construct() {}

    public function getFolioProgramacion() {
        $ultimo = FolioProgramacion::latest('id')->first();
        // Validamos si existe el registro antes de acceder a la propiedad
        $numero = $ultimo ? ($ultimo->folio + 1) : 1;

        $folioModel = new FolioProgramacion();
        $folioModel->folio = $numero;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "SISP-" . str_pad($numero, 5, "0", STR_PAD_LEFT);
    }

    public function getFolioCliente() {
        $ultimo = ClienteFolio::latest('id')->first();
        $numero = $ultimo ? ($ultimo->folio + 1) : 1;

        $folioModel = new ClienteFolio();
        $folioModel->folio = $numero;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return 'CL' . str_pad($numero, 4, '0', STR_PAD_LEFT);
    }

    public function getFolioCustodio() {
        $ultimo = CustodioFolio::latest('id')->first();
        $numero = $ultimo ? ($ultimo->folio + 1) : 1;

        $folioModel = new CustodioFolio();
        $folioModel->folio = $numero;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "C" . str_pad($numero, 4, "0", STR_PAD_LEFT);
    }

    public function getFolioUsuario() {
        $ultimo = UsuarioFolio::latest('id')->first();
        $numero = $ultimo ? ($ultimo->folio + 1) : 1;

        $folioModel = new UsuarioFolio();
        $folioModel->folio = $numero;
        $folioModel->anio = date('Y');
        $folioModel->save();

        return "U" . str_pad($numero, 4, "0", STR_PAD_LEFT);
    }

    public function getFolioTarifario() {
        $ultimo = TarifarioFolio::latest('id')->first();
        $numero = $ultimo ? ($ultimo->folio + 1) : 1;

        $folioModel = new TarifarioFolio();
        $folioModel->folio = $numero;
        $folioModel->anio = date('Y');
        $folioModel->save();

        // Corregí el prefijo a "T" o el que prefieras, antes decía "U"
        return "T" . str_pad($numero, 4, "0", STR_PAD_LEFT);
    }
}