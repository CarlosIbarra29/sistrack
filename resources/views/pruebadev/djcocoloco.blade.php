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
        background: linear-gradient(to bottom right, #FFFDD0, #FADADD); 
        color: #6A0DAD; 
        text-align: center;
        padding: 100px 20px;
    }

    .hero-section h1 {
        font-size: 4rem;
        font-weight: bold;
        
        color: #6A0DAD;
    }

    .hero-section p {
        font-size: 1.2rem;
        margin-top: 10px;
       
        color: #8A6DA8;
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

    .links_bandas {
        color: #4682B4;
        font-weight: bold;
        text-decoration: none;
    }

    .links_bandas:hover {
        text-decoration: underline;
    }

    .testimonials {
        background-color: #F8F4EE; 
        padding: 60px 20px;
    }

    .testimonials h2 {
        text-align: left;
        color: #4682B4;
        margin-left: 20px;
        margin-bottom: 30px;
    }

    .testimonial-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        font-size: 0.95rem; 
    }

    .testimonial-card p {
        color: #333;
        margin-bottom: 10px;
    }

    .testimonial-card strong {
        color: #555; 
        display: block;
        text-align: right; 
        margin-top: 10px;
    }


    .contact-section {
        background-color: #e2c0a3; 
        color: #4682B4; 
        padding: 60px 20px;
        text-align: center;
    }

    .contact-section h2, .contact-section p {
        color: #4682B4; 
    }

    .btn-learn-more {
        background-color: #E6ABA9; 
        color: #333; 
        border: none;
        padding: 10px 25px;
        font-size: 16px;
        border-radius: 5px;
        margin-top: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-learn-more:hover {
        background-color: #d19794; 
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
                    'link' => 'https://www.youtube.com/BlackpinkOfficial'
                ],
                [
                    'nombre' => 'Stray Kids',
                    'imagen' => 'img/logos/skz.png',
                    'descripcion' => 'Grupo masculino de JYP Entertainment, debut oficial en 2018...',
                    'link' => 'https://www.youtube.com/jypentertainment'
                ],
                [
                    'nombre' => 'BTS',
                    'imagen' => 'img/logos/BANANA_BTS_ARMY_LOGO.png',
                    'descripcion' => 'Debutó en 2013 con Big Hit. Alcanzaron fama global rápidamente...',
                    'link' => 'https://www.youtube.com/BANGTANTV'
                ],
                [
                    'nombre' => 'LE SSERAFIM',
                    'imagen' => 'img/logos/le sserafim.jpg',
                    'descripcion' => 'Grupo femenino de SOURCE MUSIC y HYBE, debutó en 2022...',
                    'link' => 'https://www.youtube.com/@LESSERAFIM_official'
                ],
            ];
        @endphp

        @foreach ($grupos as $grupo)
        <div class="col-md-3 col-sm-6"> 
            <div class="artist-card">
                <img src="{{ asset($grupo['imagen']) }}" alt="{{ $grupo['nombre'] }}">
                <div class="card-body">
                    <a href="{{ $grupo['link'] }}" class="links_bandas" target="_blank">{{ $grupo['nombre'] }}</a>
                    <p>{{ $grupo['descripcion'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- SECCIÓN DE MERCANCÍA) --}}
<section class="artist-section">
    <h2>Mercancía de los grupos</h2>
    <div class="row justify-content-center">

        @php
            $grupos_merch = [
                [
                    'nombre' => 'Blackpink',
                    'imagen' => 'img/logos/BP.jpeg',
                    'descripcion' => 'Encuentra el merch oficial de Blackpink.',
                    'link' => 'https://shop.weverse.io/es/shop/MXN/artists/32'
                ],
                [
                    'nombre' => 'Stray Kids',
                    'imagen' => 'img/logos/skz.jpg',
                    'descripcion' => 'Explora la colección oficial de Stray Kids.',
                    'link' => 'https://en.thejypshop.com/category/merch/35/'
                ],
                [
                    'nombre' => 'BTS',
                    'imagen' => 'img/logos/BTS.jpg',
                    'descripcion' => 'Descubre la amplia gama de merch de BTS.',
                    'link' => 'https://shop.weverse.io/es/shop/MXN/artists/2'
                ],
                [
                    'nombre' => 'LE SSERAFIM',
                    'imagen' => 'img/logos/lesserafim.jpg',
                    'descripcion' => 'Adquiere el merch exclusivo de LE SSERAFIM.',
                    'link' => 'https://shop.weverse.io/es/shop/MXN/artists/50'
                ],
            ];
        @endphp

        @foreach ($grupos_merch as $grupo)
        <div class="col-md-3 col-sm-6">
            <div class="artist-card">
                <img src="{{ asset($grupo['imagen']) }}" alt="{{ $grupo['nombre'] }}">
                <div class="card-body">
                    <a href="{{ $grupo['link'] }}" class="links_bandas" target="_blank">{{ $grupo['nombre'] }}</a>
                    <p>{{ $grupo['descripcion'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- TESTIMONIOS --}}
<section class="testimonials">
    <h2 class="mb-1">Testimonios de Fans</h2>
    <div class="row justify-content-center">
      
        <div class="col-md-3 col-sm-6">
            <div class="testimonial-card">
                <p>"Blackpink cambió mi vida, son únicas."</p>
                <strong>- Ari</strong>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="testimonial-card">
                <p>"BTS me inspira a seguir mis sueños. ¡Son increíbles!"</p>
                <strong>- Ari</strong>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="testimonial-card">
                <p>"Stray Kids me inspira a ser yo mismo sin miedo. Su música es cruda y honesta, y me hace sentir que no estoy solo en mis luchas. ¡Son mi fuerza!"</p>
                <strong>- Ari</strong>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="testimonial-card">
                <p>"LE SSERAFIM me ha cautivado con su confianza y mensajes de empoderamiento. Cada canción y cada actuación irradian una fuerza y determinación que realmente me inspiran a perseguir mis propias metas sin miedo."</p>
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