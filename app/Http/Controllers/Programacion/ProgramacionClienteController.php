<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\Folio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente\Cliente;
use App\Models\Custodio\Custodio;
use App\Models\Tarifario\Tarifario;
use App\Models\Programacion\Programacion;
use App\Models\Programacion\AcompanantesProgramacion;
use App\Models\Programacion\EstatusProgramacion;
use App\Models\Programacion\FolioProgramacion;
use App\Models\Programacion\EstadiasProgramacion;
use App\Models\Programacion\MonitoreoProgramacion;
use App\Models\Programacion\MonitoreoIncidencias;
use App\Models\Programacion\ProgramacionObservacion;

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProgramacionClienteController extends Controller
{
    protected $folio;
    public function __construct(Folio $folio)
    {
        $this->middleware('auth');
        $this->folio = $folio;
    }

    public function nuevoservicio()
    {
    	return view('programacion.cliente.nuevoservicio');
    }
}