@extends('layouts.app')

@push('scripts')
<script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
/* ===================== */
/* EXECUTIVE REPORT UI */
/* ===================== */
:root{
 --brand:#D4AF37;
 --ink:#121212;
 --soft:#f5f5f5;
 --border:#e4e4e4;
 --muted:#777;
}

body,.app-content{
 background:white!important;
 color:var(--ink);
 font-family:'Georgia','Times New Roman',serif;
}

/* COVER */
.report-cover{
 display:grid;
 grid-template-columns:3fr 1fr;
 gap:40px;
 margin-bottom:50px;
 border-bottom:3px solid var(--brand);
 padding-bottom:35px;
}

.cover-title h1{
 font-size:48px;
 margin:0;
 letter-spacing:-1px;
}

.cover-title small{
 font-size:12px;
 letter-spacing:.4em;
 color:var(--muted);
}

.cover-meta{
 text-align:right;
 font-size:12px;
}

/* SUMMARY */
.report-summary{
 display:grid;
 grid-template-columns:repeat(4,1fr);
 gap:30px;
 margin-bottom:50px;
}

.summary-item{
 border-top:3px solid var(--brand);
 padding-top:10px;
}

.summary-item span{
 display:block;
 color:var(--muted);
 letter-spacing:.2em;
 font-size:11px;
}

.summary-item strong{
 font-size:34px;
}

/* SECTION */
.report-section{
 margin-bottom:60px;
}

.section-header{
 display:flex;
 justify-content:space-between;
 align-items:flex-end;
 border-left:4px solid var(--brand);
 padding-left:15px;
 margin-bottom:15px;
}

.section-header h2{
 margin:0;
 font-size:22px;
}

.section-header small{
 color:var(--muted);
 font-size:11px;
 letter-spacing:.3em;
}

/* TEXT BLOCKS */
.report-block{
 line-height:1.8;
 font-size:14px;
 max-width:880px;
}

/* ALERT LIST */
.alert-list{
 margin:0;
 padding:0;
 list-style:none;
}

.alert-list li{
 display:flex;
 justify-content:space-between;
 padding:10px 0;
 border-bottom:1px dotted var(--border);
 font-size:14px;
}

/* TABLE */
.report-table{
 width:100%;
 border-collapse:collapse;
 font-size:13px;
 margin-top:20px;
}

.report-table th{
 border-bottom:2px solid var(--brand);
 font-size:11px;
 letter-spacing:.2em;
 text-align:left;
 padding-bottom:6px;
}

.report-table td{
 border-bottom:1px solid var(--border);
 padding:6px 4px;
}

/* REPORT FILTER */
.report-form input, .report-form select{
 width:100%;
 margin-top:8px;
 padding:5px;
 border:1px solid var(--border);
}

.report-btn{
 margin-top:10px;
 border:1px solid var(--brand);
 background:white;
 padding:6px;
 width:100%;
}

.report-btn:hover{background:var(--brand);}

/* CALENDAR */
.report-calendar{
 border:1px dashed var(--border);
 height:150px;
 display:flex;
 align-items:center;
 justify-content:center;
 font-style:italic;
 color:var(--muted);
}
</style>
@endpush


@section('title','Reporte Ejecutivo')

@section('content')

{{-- COVER --}}
<div class="report-cover">
<div class="cover-title">
<h1>Corporate Intelligence Report</h1>
<small>CUSTOMER BEHAVIOR & OPERATIONS</small>
</div>
<div class="cover-meta">
EDITION 2025<br>
BOARD LEVEL VIEW
</div>
</div>

{{-- SUMMARY --}}
<div class="report-summary">
<div class="summary-item"><span>ACTIVOS</span><strong>{{ $clientesActivos ?? '—' }}</strong></div>
<div class="summary-item"><span>RIESGO</span><strong>{{ $clientesRiesgo ?? '—' }}</strong></div>
<div class="summary-item"><span>VENCIDOS</span><strong>{{ $pagosVencidos ?? '—' }}</strong></div>
<div class="summary-item"><span>VIP</span><strong>{{ $clientesVIP ?? '—' }}</strong></div>
</div>

{{-- ALERTS --}}
<div class="report-section">
<div class="section-header">
<h2>Critical Notifications</h2>
<small>SYSTEM SIGNALS</small>
</div>

<ul class="alert-list">
<li><span>Upcoming payments</span><strong>8</strong></li>
<li><span>Pending phone calls</span><strong>5</strong></li>
<li><span>Inactive customers</span><strong>4</strong></li>
<li><span>Overdue tasks</span><strong>6</strong></li>
<li><span>Risk exposure</span><strong>3</strong></li>
<li><span>Automated events</span><strong>2</strong></li>
</ul>
</div>

{{-- CLIENTS --}}
<div class="report-section">
<div class="section-header">
<h2>Customer Overview</h2>
<small>PORTFOLIO SNAPSHOT</small>
</div>

<table class="report-table">
<thead>
<tr><th>ID</th><th>CLIENT</th><th>GROUP</th></tr>
</thead>
<tbody>
@foreach($data as $c)
<tr>
<td>{{ $c->num_list }}</td>
<td>{{ $c->nombre_cliente }}</td>
<td>{{ $c->grupo }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>

{{-- CALENDAR --}}
<div class="report-section">
<div class="section-header">
<h2>Strategic Calendar</h2>
<small>SCHEDULE VIEW</small>
</div>
<div class="report-calendar">Corporate agenda timeline</div>
</div>

{{-- REPORT --}}
<div class="report-section">
<div class="section-header">
<h2>Revenue Analysis</h2>
<small>FILTERS</small>
</div>

<div class="report-form">
<select><option>User</option></select>
<input type="date">
<input type="date">
<button class="report-btn">Run analysis</button>
</div>
</div>

@endsection
