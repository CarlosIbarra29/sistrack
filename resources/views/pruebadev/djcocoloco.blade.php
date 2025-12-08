@extends('layouts.app')

@push('styles')
<style>
    :root {
        --gold: #D4AF37;
        --blue: #1A2B4C;
        --light-gray: #f7f7f7;
        --text-dark: #333;
    }

    body, .app-content {
        background: #ffffff !important;
    }

    /* TÍTULO GENERAL */
    .section-title {
        font-size: 26px;
        font-weight: 700;
        color: var(--blue);
        margin-bottom: 25px;
        letter-spacing: -0.5px;
    }

    /* CONTENEDOR GRID */
    .alert-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 22px;
    }

    /* TARJETAS MINIMALISTAS */
    .alert-card {
        background: white;
        border: 1px solid #e8e8e8;
        padding: 22px;
        border-radius: 14px;
        transition: 0.3s ease;
    }

    .alert-card:hover {
        border-color: var(--gold);
        box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
    }

    .alert-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .alert-header i {
        font-size: 20px;
        color: var(--blue);
    }

    .alert-title {
        font-size: 17px;
        font-weight: 700;
        color: var(--blue);
    }

    .alert-value {
        font-size: 32px;
        font-weight: 800;
        color: var(--gold);
        margin-top: 4px;
    }

    .divider {
        height: 1px;
        background: #eaeaea;
        margin: 14px 0;
    }

    /* TABLA MINIMALISTA */
    .table-minimal {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #eee;
    }

    .table-minimal thead {
        background: var(--blue);
        color: white;
    }

    .table-minimal th {
        padding: 12px;
        font-size: 15px;
        text-align: left;
    }

    .table-minimal td {
        padding: 14px;
        border-bottom: 1px solid #f2f2f2;
        color: var(--text-dark);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-warning { background: #FFF5D6; color: #B38400; }
    .status-danger { background: #FFE0E0; color: #B30000; }
    .status-info { background: #E6F0FF; color: #003E95; }
    .status-safe { background: #E5FFD9; color: #2B7A0B; }

</style>
@endpush

@section('content')

<div class="container">

    <h2 class="section-title">🔔 LISTAS</h2>

    <!-- GRID DE TARJETAS -->
    <div class="alert-grid">

        <!-- Pagos próximos -->
        <div class="alert-card">
            <div class="alert-header">
                <i class="fas fa-wallet"></i>
                <span class="alert-title">Pagos próximos</span>
            </div>
            <div class="alert-value">12</div>
            <div class="divider"></div>
            <small>Clientes con pagos programados los próximos 7 días.</small>
        </div>


        <!-- Clientes inactivos -->
        <div class="alert-card">
            <div class="alert-header">
                <i class="fas fa-user-clock"></i>
                <span class="alert-title">Clientes inactivos</span>
            </div>
            <div class="alert-value">8</div>
            <div class="divider"></div>
            <small>Clientes sin actividad en más de 30 días.</small>
        </div>

        <!-- Tareas vencidas -->
        <div class="alert-card">
            <div class="alert-header">
                <i class="fas fa-exclamation-circle"></i>
                <span class="alert-title">Tareas vencidas</span>
            </div>
            <div class="alert-value">3</div>
            <div class="divider"></div>
            <small>Tareas importantes que requieren atención inmediata.</small>
        </div>

        <!-- Clientes en riesgo -->
        <div class="alert-card">
            <div class="alert-header">
                <i class="fas fa-user-shield"></i>
                <span class="alert-title">Clientes en riesgo</span>
            </div>
            <div class="alert-value">4</div>
            <div class="divider"></div>
            <small>Clientes con señales de abandono o retrasos.</small>
        </div>

      

    </div>

    <!-- TABLA DETALLADA DE ALERTAS -->
    <table class="table-minimal">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Tipo de Alerta</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Juan Pérez</td>
                <td>Pago próximo</td>
                <td>10/12/2025</td>
                <td><span class="status-badge status-warning">Próximo</span></td>
            </tr>

            <tr>
                <td>María López</td>
                <td>Llamada pendiente</td>
                <td>Hoy</td>
                <td><span class="status-badge status-info">Pendiente</span></td>
            </tr>

            <tr>
                <td>Oscar Díaz</td>
                <td>Tarea vencida</td>
                <td>Ayer</td>
                <td><span class="status-badge status-danger">Vencido</span></td>
            </tr>

            <tr>
                <td>Carla Ramos</td>
                <td>Cliente en riesgo</td>
                <td>05/12/2025</td>
                <td><span class="status-badge status-danger">Riesgo</span></td>
            </tr>

            <tr>
                <td>Grupo Kora</td>
                <td>Evento automático</td>
                <td>Hoy</td>
                <td><span class="status-badge status-safe">Atendido</span></td>
            </tr>
        </tbody>
    </table>

</div>

@endsection
