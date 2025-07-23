@extends('layouts.app')

@push('scripts')
{{-- Puedes incluir JS personalizado aquí --}}
@endpush

@section('title')
    Página KPOP
@endsection

@section('content')

<style>
    .hero-section {
        background: url('{{ asset('img/kpop-bg.jpg') }}') center center / cover no-repeat;
        color: white;
        text-align: center;
        padding: 100px 20px;
    }

    .hero-section h1 {
        font-size: 4rem;
        font-weight: bold;
    }

    .hero-section p {
        font-size: 1.2rem;
        margin-top: 10px;
    }

    .artist-section {
        background-color: #fff;
        padding: 60px 20px;
        text-align: center;
    }

    .artist-section h2 {
        margin-bottom: 40px;
    }

    .artist-card {
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 30px;
        background-color: #f7f7f7;
        transition: transform 0.3s;
    }

    .artist-card:hover {
        transform: translateY(-5px);
    }

    .artist-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .artist-card .card-body {
        padding: 20px;
        text-align: left;
    }

    .testimonials {
        background-color: #f1e1d6;
        padding: 60px 20px;
    }

    .testimonial-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .contact-section {
        background-color: #d4a373;
        color: white;
        padding: 60px 20px;
        text-align: center;
    }

    .btn-learn-more {
        background-color: #6a4e42;
        color: white;
        border: none;
        padding: 10px 25px;
        font-size: 16px;
        border-radius: 5px;
        margin-top: 15px;
    }
</style>

{{-- PORTADA --}}
<section class="hero-section">
    <h1>Bienvenidos al Mundo del KPOP</h1>
    <p>Explora artistas, historias y más sobre tus grupos favoritos</p>
</section>

{{-- SECCIÓN DE ARTISTAS --}}
<section class="artist-section">
    <h2>Conoce a los Grupos</h2>
    <div class="row justify-content-center">
        @php
            $grupos = [
                [
                    'nombre' => 'Blackpink',
                    'imagen' => 'img/logos/descarga (1).png',
                    'descripcion' => 'Grupo femenino de YG Entertainment, debutó en 2016...',
                ],
                [
                    'nombre' => 'Stray Kids',
                    'imagen' => 'img/logos/skz.png',
                    'descripcion' => 'Grupo masculino de JYP Entertainment, debut oficial en 2018...',
                ],
                [
                    'nombre' => 'BTS',
                    'imagen' => 'img/logos/BANANA_BTS_ARMY_LOGO.png',
                    'descripcion' => 'Debutó en 2013 con Big Hit. Alcanzaron fama global rápidamente...',
                ],
                [
                    'nombre' => 'TWICE',
                    'imagen' => 'img/logos/twice.jpg',
                    'descripcion' => 'Grupo femenino de JYP que conquistó Corea y Japón desde 2016...',
                ],
            ];
        @endphp

        @foreach ($grupos as $grupo)
        <div class="col-md-3">
            <div class="artist-card">
                <img src="{{ asset($grupo['imagen']) }}" alt="{{ $grupo['nombre'] }}">
                <div class="card-body">
                    <h4>{{ $grupo['nombre'] }}</h4>
                    <p>{{ $grupo['descripcion'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- TESTIMONIOS --}}
<section class="testimonials">
    <h2 class="mb-5">Testimonios de Fans</h2>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="testimonial-card">
                <p>"Blackpink cambió mi vida, son únicas."</p>
                <strong>- Ari</strong>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial-card">
                <p>"BTS me inspira a seguir mis sueños. ¡Son increíbles!"</p>
                <strong>- Ari</strong>
            </div>
        </div>
    </div>
</section>

{{-- CONTACTO --}}
<section class="contact-section">
    <h2>¿Quieres Saber Más?</h2>
    <p>Descubre noticias, eventos y más sobre tus artistas KPOP favoritos.</p>
    <button class="btn-learn-more">Aprende más</button>
</section>

@endsection
