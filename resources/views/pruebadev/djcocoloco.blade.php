@extends('layouts.app')

@push('scripts')
<script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
:root { --gold:#D4AF37; --gold-dark:#B8860B; --black:#000; }
.icon-gold i { color: var(--gold); }
.btn-outline-gold { border:1px solid var(--gold); color:var(--gold); }
.btn-outline-gold:hover{ background:var(--gold); color:#000; }

.badge-active-green { background:#28a745; color:#fff; padding:6px 12px; border-radius:12px; }
.badge-reminder { background:#ff9800; color:#fff; padding:4px 8px; border-radius:8px; }
.timeline-reminder { max-height:120px; overflow:auto; font-size:13px; }

.card-stats .card-body { text-align:center; }
.report-row { gap:8px; display:flex; align-items:center; }
.calendar { border:1px solid #e9ecef; border-radius:6px; padding:10px; }
.calendar-grid { display:grid; grid-template-columns: repeat(7,1fr); gap:6px; }
.calendar-cell { min-height:90px; border:1px dashed #eee; padding:6px; border-radius:4px; background:#fff; position:relative; }
.event-pill { display:block; background:#f1f1f1; padding:4px 6px; border-radius:6px; margin-bottom:4px; font-size:12px; cursor:pointer; }
.controls { display:flex; gap:8px; align-items:center; }
.small-muted { font-size:12px; color:#6c757d; }
</style>
@endpush

@section('title','Inventario de clientes — CRM')

@section('content')

<div class="d-flex flex-row">
 <div class="flex-row-fluid">
  <div class="d-flex flex-column">

   {{-- TOP: STATS + REPORTS --}}
   <div class="row mb-4">
     <div class="col-md-8">
       <div class="row card-stats">
         <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><h4>{{ $clientesActivos ?? '—' }}</h4><small>Activos</small></div></div></div>
         <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><h4>{{ $clientesRiesgo ?? '—' }}</h4><small>En riesgo</small></div></div></div>
         <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><h4>{{ $pagosVencidos ?? '—' }}</h4><small>Pagos vencidos</small></div></div></div>
         <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><h4>{{ $clientesVIP ?? '—' }}</h4><small>VIP</small></div></div></div>
       </div>
     </div>

     {{-- REPORTS PANEL --}}
     <div class="col-md-4">
       <div class="card shadow-sm">
         <div class="card-body">
           <h6 class="mb-3">Reportes por usuario</h6>
           <div class="report-row mb-2">
             <select id="filtro_usuario" class="form-control">
               <option value="">— Selecciona usuario —</option>
               @foreach($usuarios ?? [] as $u)
                 <option value="{{ $u->id }}">{{ $u->name }}</option>
               @endforeach
             </select>
           </div>
           <div class="report-row mb-2">
             <input type="date" id="repor_fecha_ini" class="form-control">
             <input type="date" id="repor_fecha_fin" class="form-control">
           </div>
           <div class="report-row mb-2">
             <select id="repor_estado" class="form-control">
               <option value="">Todos</option>
               <option value="pending">Pendiente</option>
               <option value="done">Completados</option>
             </select>
           </div>
           <div class="d-flex justify-content-between mt-3">
             <button class="btn btn-primary btn-sm" onclick="generarReporte()">Generar</button>
             <div>
               <button class="btn btn-outline-secondary btn-sm" onclick="exportReportCSV()">CSV</button>
               <button class="btn btn-outline-secondary btn-sm" onclick="exportReportExcel()">Excel</button>
             </div>
           </div>
           <div id="report_result" class="mt-3 small-muted">Sin resultados</div>
         </div>
       </div>
     </div>
   </div>

   {{-- MAIN: TABLE + CALENDAR SIDE BY SIDE --}}
   <div class="row">
     <div class="col-md-8">
       <div class="card shadow-sm">
         <div class="card-header bg-white d-flex justify-content-between align-items-center">
           <div><h4 class="mb-0">Inventario de clientes</h4></div>
           <div class="controls">
             <button class="btn btn-sm btn-outline-secondary" onclick="toggleCalendar()">Ver calendario</button>
             <a href="{{ route('cliente.listadoclienteinactivo') }}" class="btn btn-sm btn-light-secondary">Inactivos</a>
           </div>
         </div>

         <div class="card-body">
           <table class="table table-striped table-borderless table-hover" id="kdatatable_clientes">
             <thead>
               <tr>
                 <th>Folio.</th>
                 <th>Razon social</th>
                 <th>Nombre cliente</th>
                 <th>Grupo</th>
                 <th class="text-center">Estado</th>
                 <th class="text-center">Eventos / Acciones</th>
               </tr>
             </thead>
             <tbody>
               @foreach($data as $unid)
               <tr>
                 <td>{{ $unid->num_list }}</td>
                 <td>{{ $unid->razon_social }}</td>
                 <td>{{ $unid->nombre_cliente }}</td>
                 <td>{{ $unid->grupo }}</td>
                 <td class="text-center">
                   <span class="badge-active-green">Activo</span>
                 </td>
                 <td class="text-center">
                   <a href="{{ route('cliente.vercliente', $unid->id) }}" class="btn btn-sm btn-icon btn-outline-gold mr-1" title="Ver cliente"><i class="flaticon-eye icon-gold"></i></a>
                   <a href="{{ route('cliente.editarcliente', $unid->id) }}" class="btn btn-sm btn-icon btn-outline-gold mr-1" title="Editar cliente"><i class="flaticon-edit icon-gold"></i></a>

                   {{-- Botones inteligentes --}}
                   @if($unid->vip ?? false)
                     <button class="btn btn-sm btn-warning">⭐ Prioritario</button>
                   @elseif($unid->deuda ?? false)
                     <button class="btn btn-sm btn-danger">💰 Cobrar</button>
                   @else
                     <button class="btn btn-sm btn-secondary" onclick="abrirRecordatorio('{{ $unid->id }}','{{ addslashes($unid->nombre_cliente) }}')">📞 Llamar</button>
                   @endif

                   {{-- Abrir recordatorios --}}
                   <button class="btn btn-sm btn-outline-warning" onclick="abrirRecordatorio('{{ $unid->id }}','{{ addslashes($unid->nombre_cliente) }}')">🔔</button>

                   {{-- Ver timeline rápido (mini) --}}
                   <button class="btn btn-sm btn-info" onclick="verTimeline('{{ $unid->id }}')">🕒</button>
                 </td>
               </tr>
               @endforeach
             </tbody>
           </table>
         </div>
       </div>
     </div>

     {{-- CALENDAR & QUICK TASKS --}}
     <div class="col-md-4">
       <div class="card shadow-sm">
         <div class="card-header bg-white d-flex justify-content-between align-items-center">
           <div><h5 class="mb-0">Calendario de tareas</h5></div>
           <div>
             <button class="btn btn-sm btn-outline-secondary" onclick="prevMonth()">◀</button>
             <button class="btn btn-sm btn-outline-secondary" onclick="nextMonth()">▶</button>
           </div>
         </div>
         <div class="card-body calendar">
           <div class="mb-2 d-flex justify-content-between align-items-center">
             <strong id="calendar_header"></strong>
             <small class="small-muted" id="calendar_sub"></small>
           </div>

           <div id="calendar_view" class="calendar-grid"></div>

           <div class="mt-2 d-flex justify-content-between">
             <button class="btn btn-sm btn-primary" onclick="openQuickTask()">Nueva tarea</button>
             <button class="btn btn-sm btn-outline-secondary" onclick="loadCalendarEvents()">Actualizar</button>
           </div>
         </div>
       </div>

       {{-- QUICK REPORT SUMMARY --}}
       <div class="card mt-3">
         <div class="card-body">
           <h6>Resumen rápido</h6>
           <p class="mb-1 small-muted">Tareas pendientes: <span id="summary_pending">0</span></p>
           <p class="mb-1 small-muted">Tareas hoy: <span id="summary_today">0</span></p>
           <p class="mb-0 small-muted">Tareas próximas 7 días: <span id="summary_week">0</span></p>
         </div>
       </div>

     </div>
   </div>

  </div>
 </div>
</div>

{{-- MODAL RECORDATORIOS (reutilizable) --}}
<div class="modal fade" id="modalRecordatorio" tabindex="-1">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-warning text-white">
     <h5>Recordatorio / Tarea</h5>
     <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
     <input type="hidden" id="record_cliente_id">
     <div class="form-row">
       <div class="col-md-6">
         <label>Cliente</label>
         <input type="text" id="record_cliente_nombre" class="form-control" readonly>
       </div>
       <div class="col-md-6">
         <label>Fecha y hora</label>
         <input type="datetime-local" id="record_fecha" class="form-control">
       </div>
       <div class="col-12 mt-2">
         <label>Tipo</label>
         <select id="record_tipo" class="form-control">
           <option value="llamada">Llamada</option>
           <option value="renovacion">Renovación</option>
           <option value="pago">Pago vencido</option>
           <option value="otro">Otro</option>
         </select>
       </div>
       <div class="col-12 mt-2">
         <label>Nota</label>
         <textarea id="record_nota" class="form-control"></textarea>
       </div>
     </div>

     <hr>
     <h6>Recordatorios existentes</h6>
     <div id="lista_recordatorios" class="timeline-reminder">
       <small class="text-muted">Cargando...</small>
     </div>
   </div>

   <div class="modal-footer">
     <button class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
     <button class="btn btn-warning" onclick="guardarRecordatorio(true)">Guardar y cerrar</button>
   </div>
  </div>
 </div>
</div>

{{-- MODAL TIMELINE (rápido) --}}
<div class="modal fade" id="modalTimeline">
 <div class="modal-dialog modal-md">
  <div class="modal-content">
   <div class="modal-header"><h5>Timeline</h5></div>
   <div class="modal-body" id="modalTimelineBody">
     Cargando...
   </div>
  </div>
 </div>
</div>

{{-- QUICK TASK modal (desde calendario) --}}
<div class="modal fade" id="modalQuickTask">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header"><h5>Nueva tarea rápida</h5></div>
   <div class="modal-body">
     <label>Título</label>
     <input id="quick_title" class="form-control">
     <label class="mt-2">Fecha</label>
     <input id="quick_fecha" type="date" class="form-control">
     <label class="mt-2">Cliente (opcional)</label>
     <select id="quick_cliente" class="form-control">
       <option value="">— Sin cliente —</option>
       @foreach($data as $c) <option value="{{ $c->id }}">{{ $c->nombre_cliente }}</option> @endforeach
     </select>
   </div>
   <div class="modal-footer">
     <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
     <button class="btn btn-primary" onclick="guardarQuickTask()">Guardar</button>
   </div>
  </div>
 </div>
</div>

{{-- SCRIPTS --}}
<script>
/* ---------- REPORTS (frontend export & generation) ---------- */
function generarReporte(){
  const user = document.getElementById('filtro_usuario').value;
  const ini = document.getElementById('repor_fecha_ini').value;
  const fin = document.getElementById('repor_fecha_fin').value;
  const estado = document.getElementById('repor_estado').value;

  // Ejemplo: filtrado en cliente-side usando dataset disponible en window.__CLIENTS_DATA
  // Si quieres server-side, llama a una ruta con fetch() y devuelva JSON.
  const rows = [];
  @foreach($data as $c)
    rows.push({
      cliente_id: '{{ $c->id }}',
      cliente: `{{ addslashes($c->nombre_cliente) }}`,
      grupo: `{{ addslashes($c->grupo) }}`,
      vip: {{ ($c->vip ?? false) ? 'true' : 'false' }},
    });
  @endforeach

  // filtrar por usuario/fechas/estado -> este ejemplo solo muestra conteo
  const resultado = rows.filter(r => {
    let ok = true;
    if(user) ok = ok && (r.cliente_id == user);
    // fecha/estado se implementarían con datos reales del backend
    return ok;
  });

  document.getElementById('report_result').innerHTML = `<strong>${resultado.length}</strong> resultados (vista demo).`;
  // Guardo resultado para export
  window.__REPORT_RESULT = resultado;
}

function exportReportCSV(){
  const rows = window.__REPORT_RESULT || [];
  if(rows.length==0){ alert('No hay datos para exportar'); return; }
  const header = Object.keys(rows[0]).join(',');
  const csv = [header].concat(rows.map(r=>Object.values(r).map(v=>`"${(''+v).replace(/"/g,'""')}"`).join(','))).join('\n');
  const blob = new Blob([csv],{type:'text/csv;charset=utf-8;'});
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a'); a.href = url; a.download = `reporte_${Date.now()}.csv`; a.click(); URL.revokeObjectURL(url);
}

function exportReportExcel(){
  // simple trick: CSV renamed .xls — para export rápido. Para Excel real usa paquete server-side.
  exportReportCSV();
}

/* ---------- RECORDATORIOS (reutilizado y mejorado) ---------- */
let contador = {};
let STORE_RECORDS = {}; // estructura: { clienteId: [{id,fecha,nota,tipo,done}] }

function abrirRecordatorio(id,nombre){
  $('#modalRecordatorio').modal('show');
  document.getElementById('record_cliente_id').value = id;
  document.getElementById('record_cliente_nombre').value = nombre;
  loadRecordatoriosCliente(id);
}

function loadRecordatoriosCliente(id){
  const target = document.getElementById('lista_recordatorios');
  target.innerHTML = '<small class="text-muted">Cargando...</small>';
  // Carga desde STORE_RECORDS (demo). En producción, fetch('/cliente/recordatorios/'+id)
  setTimeout(()=>{
    const items = STORE_RECORDS[id] || [];
    if(items.length===0){ target.innerHTML = '<small class="text-muted">No hay recordatorios</small>'; }
    else {
      target.innerHTML = '';
      items.forEach((r,i)=>{
        const div = document.createElement('div');
        div.className = 'note-item';
        div.innerHTML = `<div><b>${r.tipo || 'Tarea'}</b> · ${r.fecha}</div><div>${r.nota}</div>`;
        target.appendChild(div);
      });
    }
  },200);
}

function guardarRecordatorio(closeAfter=false){
  const id = document.getElementById('record_cliente_id').value;
  const fecha = document.getElementById('record_fecha').value;
  const nota = document.getElementById('record_nota').value;
  const tipo = document.getElementById('record_tipo').value;
  if(!fecha || !nota){ alert('Completa fecha y nota'); return; }

  const item = { id: Date.now(), fecha, nota, tipo, done:false };
  if(!STORE_RECORDS[id]) STORE_RECORDS[id]=[];
  STORE_RECORDS[id].push(item);

  // actualiza contador visual en tabla (si existe)
  const badge = document.getElementById('contadorRecordatorio'+id);
  if(badge) badge.innerText = (parseInt(badge.innerText||'0') + 1);

  loadRecordatoriosCliente(id);
  loadCalendarEvents(); // actualizar calendario
  if(closeAfter) $('#modalRecordatorio').modal('hide');
  // En producción: POST a /cliente/recordatorio con fetch/AJAX
}

/* ---------- TIMELINE / QUICK VIEW ---------- */
function verTimeline(id){
  const body = document.getElementById('modalTimelineBody');
  const items = STORE_RECORDS[id] || [];
  if(items.length===0) body.innerHTML = '<small>No hay eventos</small>';
  else body.innerHTML = items.map(i=>`<div class="note-item"><b>${i.tipo}</b> ${i.fecha}<div>${i.nota}</div></div>`).join('');
  $('#modalTimeline').modal('show');
}

/* ---------- QUICK TASK (from calendar) ---------- */
function openQuickTask(){
  $('#modalQuickTask').modal('show');
}

function guardarQuickTask(){
  const title = document.getElementById('quick_title').value;
  const fecha = document.getElementById('quick_fecha').value;
  const cliente = document.getElementById('quick_cliente').value;
  if(!title || !fecha){ alert('Completa título y fecha'); return; }
  // guardado local demo
  const cid = cliente || 'noglobal';
  if(!STORE_RECORDS[cid]) STORE_RECORDS[cid]=[];
  STORE_RECORDS[cid].push({ id:Date.now(), fecha: fecha + 'T09:00', nota: title, tipo:'quick', done:false });
  $('#modalQuickTask').modal('hide');
  loadCalendarEvents();
}

/* ---------- CALENDAR (simple grid month view) ---------- */
let currentDate = new Date();

function startOfMonth(d){ return new Date(d.getFullYear(), d.getMonth(), 1); }
function endOfMonth(d){ return new Date(d.getFullYear(), d.getMonth()+1, 0); }
function formatDateISO(d){ return d.toISOString().slice(0,19).replace('T',' '); }
function monthName(d){ return d.toLocaleString('default',{month:'long', year:'numeric'}); }

function loadCalendarEvents(){
  renderCalendar(currentDate);
  updateSummary();
}

function renderCalendar(date){
  const header = document.getElementById('calendar_header');
  header.innerText = monthName(date);
  const grid = document.getElementById('calendar_view');
  grid.innerHTML = '';

  const start = startOfMonth(date);
  const end = endOfMonth(date);
  const startDay = start.getDay(); // 0..6
  const days = end.getDate();

  // add blanks
  for(let b=0;b<startDay;b++){ const div=document.createElement('div'); div.className='calendar-cell'; grid.appendChild(div); }

  for(let day=1; day<=days; day++){
    const cell = document.createElement('div'); cell.className='calendar-cell';
    const cellDate = new Date(date.getFullYear(), date.getMonth(), day);
    const iso = cellDate.toISOString().slice(0,10);
    const title = document.createElement('div'); title.innerHTML = `<strong>${day}</strong>`; cell.appendChild(title);

    // find events in STORE_RECORDS matching date (startsWith iso)
    Object.keys(STORE_RECORDS).forEach(cid=>{
      (STORE_RECORDS[cid]||[]).forEach(ev=>{
        if(ev.fecha && ev.fecha.startsWith(iso)){
          const pill = document.createElement('div');
          pill.className='event-pill';
          pill.innerText = `${ev.tipo || 'Tarea'} — ${ev.nota}`;
          pill.onclick = ()=> { alert(`${ev.tipo}\n${ev.fecha}\n\n${ev.nota}`); };
          cell.appendChild(pill);
        }
      });
    });

    grid.appendChild(cell);
  }
}

function prevMonth(){ currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth()-1,1); loadCalendarEvents(); }
function nextMonth(){ currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth()+1,1); loadCalendarEvents(); }

function toggleCalendar(){ const el = document.querySelector('.calendar'); if(el) el.scrollIntoView({behavior:'smooth'}); }

/* ---------- SUMMARY ---------- */
function updateSummary(){
  let pending=0, today=0, week=0;
  const todayISO = new Date().toISOString().slice(0,10);
  const weekLimit = new Date(); weekLimit.setDate(weekLimit.getDate()+7); const weekISO = weekLimit.toISOString().slice(0,10);

  Object.keys(STORE_RECORDS).forEach(cid=>{
    (STORE_RECORDS[cid]||[]).forEach(ev=>{
      if(!ev.done) pending++;
      if(ev.fecha && ev.fecha.startsWith(todayISO)) today++;
      if(ev.fecha && ev.fecha.slice(0,10) <= weekISO) week++;
    });
  });

  document.getElementById('summary_pending').innerText = pending;
  document.getElementById('summary_today').innerText = today;
  document.getElementById('summary_week').innerText = week;
}

/* ---------- Inicializar demo ---------- */
document.addEventListener('DOMContentLoaded', function(){
  // demo: si quieres cargar recordatorios server-side, haz fetch aquí y populate STORE_RECORDS
  loadCalendarEvents();
});
</script>

@endsection
