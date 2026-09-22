<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8" />

    <title>
        {{ config('app.name', 'Sistrack for SISPROTEC Sistema de Administración') }} login
    </title>

    <meta name="description" content="Sistrack for SISPROTEC Sistema de Administración" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="noindex, nofollow" />

    <!-- icono pestaña -->
    <link rel="icon" type="image/png" href="img/logos/logo_login.png">

    <!-- FUENTES -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <link href="{{ asset('theme/assets/css/pages/login/login-2.css') }}" rel="stylesheet" type="text/css" />

    <!-- ESTILOS METRONIC -->
    <link href="{{ asset('theme/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('theme/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('theme/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!-- Base general -->
    <link href="{{ asset('theme/assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('theme/assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('theme/assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('theme/assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />

    <!-- css LOGIN -->
    <link href="{{ asset('css/login_sistrack.css?v=1.0.4') }}" rel="stylesheet" type="text/css" />

</head>


<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading sistrack-login-body">


<div class="d-flex flex-column flex-root">

    <!-- LOGIN -->
    <div class="login login-2 login-signin-on sistrack-login-layout"
         id="kt_login">

        <div class="sistrack-login-left">

            <div class="sistrack-login-left-inner">

                <!-- LOGO -->
                <div class="sistrack-login-brand">

                    <a href="javascript:;" class="sistrack-login-logo-link">

                        <img src="{{ asset('img/logos/logo_login.png') }}"
                             class="sistrack-login-logo"
                             alt="SIS PROTEC" />

                    </a>

                    <div class="sistrack-brand-caption">

                        <span>PLATAFORMA OPERATIVA</span>

                        <strong>SISTRACK</strong>

                    </div>

                </div>

                <div class="sistrack-login-content">

                    <!-- FORMULARIO -->
                    <div class="login-form login-signin sistrack-login-form">

                        <form class="form"
                              action="{{ route('login') }}"
                              method="post"
                              autocomplete="off"
                              novalidate="novalidate"
                              id="kt_login_signin_form">

                            @csrf

                            <div class="sistrack-login-heading">

                                <span class="sistrack-login-eyebrow">ACCESO SEGURO</span>
                                <h2>Bienvenido</h2>
                                <p>Ingresa tus credenciales para acceder al sistema de administración y monitoreo.</p>
                            
                            </div>

                            @if (count($errors) > 0)

                                <div class="sistrack-login-errors">

                                    @foreach ($errors->all() as $message)

                                        <div class="alert alert-custom alert-outline-danger fade show mb-3 animate__animated animate__fadeIn sistrack-login-alert"
                                             role="alert">

                                            <div class="alert-icon">
                                                <i class="flaticon-warning"></i>
                                            </div>

                                            <div class="alert-text">
                                                {{ $message }}
                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            @endif

                            <div class="form-group sistrack-login-field">

                                <label class="sistrack-login-label">
                                    {{ __('Correo') }}
                                </label>

                                <div class="sistrack-login-input-wrapper">

                                    <span class="sistrack-login-input-icon">
                                        <i class="la la-envelope"></i>
                                    </span>

                                    <input
                                        class="form-control h-auto py-5 px-6 rounded-lg font-size-lg font-weight-bold sistrack-login-input"
                                        type="email"
                                        name="email"
                                        autocomplete="off"
                                        value="{{ old('email') }}"
                                        placeholder="correo@empresa.com"
                                        required
                                        autofocus />

                                </div>

                            </div>

                            <div class="form-group sistrack-login-field">

                                <div class="d-flex justify-content-between">

                                    <label class="sistrack-login-label">
                                        {{ __('Contraseña') }}
                                    </label>

                                </div>

                                <div class="sistrack-login-input-wrapper">

                                    <span class="sistrack-login-input-icon">
                                        <i class="la la-lock"></i>
                                    </span>

                                    <input
                                        class="form-control h-auto py-5 px-6 rounded-lg sistrack-login-input"
                                        type="password"
                                        name="password"
                                        autocomplete="off"
                                        placeholder="Ingresa tu contraseña"
                                        required />

                                </div>

                            </div>

                            <div class="form-group sistrack-login-field">

                                <label class="sistrack-login-label">
                                    Verificación de seguridad
                                </label>

                                <div class="sistrack-captcha-row">

                                    <div class="captcha sistrack-captcha-image">

                                        <span>
                                            {!! captcha_img('flat') !!}
                                        </span>

                                    </div>

                                    <a href="#" id="refresh-captcha" class="btn btn-icon sistrack-captcha-refresh" title="Actualizar captcha">

                                        <i class="flaticon-refresh"></i>

                                    </a>

                                    <div class="sistrack-captcha-info">

                                        <strong>CAPTCHA</strong>
                                        <span>No sensible a mayúsculas.</span>

                                    </div>

                                </div>

                                <div class="sistrack-login-input-wrapper sistrack-login-captcha-input">

                                    <span class="sistrack-login-input-icon">
                                        <i class="la la-shield"></i>
                                    </span>

                                    <input
                                        id="captcha"
                                        type="text"
                                        class="form-control sistrack-login-input"
                                        placeholder="Escribe el código mostrado"
                                        name="captcha"
                                        required>

                                </div>

                            </div>

                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center sistrack-login-options">

                                <div class="checkbox-inline">

                                    <label class="checkbox checkbox-outline m-0 sistrack-login-remember">
                                        <input type="checkbox" name="remember">
                                        <span></span>
                                        Recordar Sesión
                                    </label>

                                </div>


                                <a href="javascript:;" id="kt_login_forgot" class="sistrack-login-forgot-link">
                                    Recuperar Contraseña
                                </a>

                            </div>

                            <div class="text-center">

                                <button id="kt_login_signin_submit" type="submit" class="btn btn-lg btn-block font-weight-bolder sistrack-login-submit">

                                    <span>{{ __('Iniciar Sesión') }}</span>
                                    <i class="la la-arrow-right"></i>

                                </button>

                            </div>

                        </form>

                    </div>

                    <form class="form"
                          novalidate="novalidate"
                          id="kt_login_signup_form">
                    </form>
                    
                    <!-- RECUPERAR CONTRASEÑA -->
                    <div class="login-form login-forgot sistrack-login-form">

                        <form class="form"
                              novalidate="novalidate"
                              id="kt_login_forgot_form">


                            <div class="sistrack-login-heading">

                                <span class="sistrack-login-eyebrow">
                                    RECUPERACIÓN DE ACCESO
                                </span>

                                <h2>
                                    Recuperar Contraseña
                                </h2>

                                <p>
                                    Ingresa el correo asociado a tu cuenta.
                                </p>

                            </div>

                            <div class="form-group sistrack-login-field">

                                <label class="sistrack-login-label">
                                    Correo
                                </label>

                                <div class="sistrack-login-input-wrapper">

                                    <span class="sistrack-login-input-icon">
                                        <i class="la la-envelope"></i>
                                    </span>

                                    <input
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 sistrack-login-input"
                                        type="email"
                                        placeholder="correo@empresa.com"
                                        name="email"
                                        autocomplete="off" />

                                </div>

                            </div>

                            <div class="form-group d-flex flex-wrap sistrack-forgot-actions">

                                <button type="button"id="kt_login_forgot_cancel" class="btn sistrack-login-secondary">

                                    <i class="la la-arrow-left"></i>
                                    Cancelar

                                </button>

                                <button type="button"id="kt_login_forgot_submit" class="btn sistrack-login-submit sistrack-login-submit--small">

                                    Recuperar
                                    <i class="la la-arrow-right"></i>

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

                <div class="sistrack-login-footer">

                    <span>
                        SISTRACK
                    </span>

                    <span class="sistrack-login-footer-dot"></span>

                    <span>
                        SIS PROTEC
                    </span>

                    <span class="sistrack-login-footer-dot"></span>

                    <span>
                        {{ date('Y') }}
                    </span>

                </div>

            </div>

        </div>

        <div class="sistrack-login-right">

            <div class="sistrack-login-grid"></div>

            <div class="sistrack-login-glow sistrack-login-glow--top"></div>

            <div class="sistrack-login-glow sistrack-login-glow--bottom"></div>

            <div class="sistrack-login-right-content">

                <div class="sistrack-status-pill">
                    <span></span>
                    CENTRO DE CONTROL OPERATIVO
                </div>

                <div class="sistrack-right-copy">

                    <span class="sistrack-login-eyebrow">SEGURIDAD · LOGÍSTICA · MONITOREO</span>

                    <h1>Operación bajo control.</h1>

                    <p>Centraliza la programación, seguimiento y operación de los servicios de custodia desde una sola plataforma.</p>

                </div>

                <div class="sistrack-monitor-card">

                    <div class="sistrack-monitor-header">

                        <div>

                            <small>
                                SISTRACK
                            </small>

                            <strong>
                                Centro de monitoreo
                            </strong>

                        </div>

                        <span class="sistrack-online-badge">
                            <i></i>
                            OPERATIVO
                        </span>

                    </div>

                    <div class="sistrack-monitor-map">

                        <div class="sistrack-map-origin">

                            <span class="sistrack-map-dot sistrack-map-dot--origin"></span>

                            <div>

                                <small>
                                    ORIGEN
                                </small>

                                <strong>
                                    Inicio de servicio
                                </strong>

                            </div>

                        </div>

                        <div class="sistrack-map-path">

                            <span></span>

                        </div>

                        <div class="sistrack-map-destination">
                            <span class="sistrack-map-dot sistrack-map-dot--destination"></span>

                            <div>

                                <small>
                                    DESTINO
                                </small>

                                <strong>
                                    Seguimiento activo
                                </strong>

                            </div>
                        </div>

                    </div>


                    <div class="sistrack-monitor-modules">
                        <div class="sistrack-monitor-module">

                            <span>
                                <i class="la la-calendar-check-o"></i>
                            </span>

                            <div>

                                <small>
                                    PROGRAMACIÓN
                                </small>

                                <strong>
                                    Servicios
                                </strong>

                            </div>
                        </div>


                        <div class="sistrack-monitor-module">
                            <span>
                                <i class="la la-map-marker"></i>
                            </span>

                            <div>
                                <small>
                                    MONITOREO
                                </small>

                                <strong>
                                    Seguimiento
                                </strong>
                            </div>
                        </div>


                        <div class="sistrack-monitor-module">
                            <span>
                                <i class="la la-shield"></i>
                            </span>

                            <div>
                                <small>
                                    SEGURIDAD
                                </small>

                                <strong>
                                    Operación
                                </strong>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="sistrack-login-right-footer">

                <span>
                    SISTEMA DE ADMINISTRACIÓN
                </span>

                <span>
                    SIS PROTEC SEGURIDAD PRIVADA
                </span>

            </div>

        </div>

    </div>

</div>

<!-- CONFIGURACIÓN INICIAL -->
<script>
    var HOST_URL = "";
</script>


<script>

    var KTAppSettings = {

        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },

        "colors": {

            "theme": {

                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },

                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },

                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }

            },

            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }

        },

        "font-family": "Poppins"

    };

</script>

<!-- JS -->
<script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js') }}"></script>

<script src="{{ asset('theme/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>

<script src="{{ asset('theme/assets/js/scripts.bundle.js') }}"></script>

<script src="{{ asset('theme/assets/js/pages/custom/login/login-general.js') }}"></script>

</body>

</html>