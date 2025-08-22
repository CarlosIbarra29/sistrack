@extends('layouts.app')
@push('scripts')
@endpush
@section('title')
    Página KPOP
@endsection
@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* NAVBAR */
    .navbar {
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .navbar-brand {
        font-weight: bold;
        color: #FF1493 !important;
        font-size: 1.5rem;
    }
    .navbar-nav .nav-link {
        color: #6A0DAD !important;
        font-weight: 500;
    }
    .navbar-nav .nav-link:hover {
        color: #FF1493 !important;
    }

    /* HERO */
    .hero-section {
        background: linear-gradient(to right, #FFFDD0, #FADADD);
        color: #6A0DAD;
        text-align: center;
        padding: 120px 20px;
    }
    .hero-section h1 {
        font-size: 4rem;
        font-weight: bold;
    }
    .hero-section p {
        font-size: 1.2rem;
        margin-top: 10px;
    }

    /* CARDS */
    .artist-card, .concert-card {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    .artist-card:hover, .concert-card:hover {
        transform: scale(1.05);
    }
    .artist-card img, .concert-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .artist-card .card-body, .concert-card .card-body {
        padding: 20px;
        text-align: left;
    }
    .links_bandas {
        color: #FF1493;
        font-weight: bold;
        text-decoration: none;
        font-size: 1.2rem;
    }
    .links_bandas:hover {
        text-decoration: underline;
    }

    /* TESTIMONIALS */
    .testimonials {
        background-color: #F8F4EE;
        padding: 60px 20px;
    }
    .testimonial-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        font-size: 0.95rem;
        text-align: center;
    }
    .testimonial-card strong {
        color: #FF1493;
        display: block;
        margin-top: 10px;
    }

    /* FOOTER */
    .footer {
        background-color: #222;
        color: white;
        padding: 30px 20px;
        text-align: center;
    }
    .footer a {
        color: #FF1493;
        margin: 0 10px;
        text-decoration: none;
    }
    .footer a:hover {
        text-decoration: underline;
    }
</style>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">KPOP World</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#grupos">Grupos</a></li>
        <li class="nav-item"><a class="nav-link" href="#merch">Merch</a></li>
        <li class="nav-item"><a class="nav-link" href="#noticias">Noticias</a></li>
        <li class="nav-item"><a class="nav-link" href="#testimonios">Fans</a></li>
      </ul>
    </div>
  </div>
</nav>

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
                ['nombre' => 'Blackpink','imagen' => 'img/logos/descarga (1).png','descripcion' => 'Grupo femenino de YG Entertainment, debutó en 2016.','link' => 'https://www.youtube.com/BlackpinkOfficial'],
                ['nombre' => 'Stray Kids','imagen' => 'img/logos/skz.png','descripcion' => 'Grupo masculino de JYP Entertainment, debut oficial en 2018.','link' => 'https://www.youtube.com/jypentertainment'],
                ['nombre' => 'BTS','imagen' => 'img/logos/BANANA_BTS_ARMY_LOGO.png','descripcion' => 'Debutó en 2013 con Big Hit. Alcanzaron fama global rápidamente.','link' => 'https://www.youtube.com/BANGTANTV'],
                ['nombre' => 'LE SSERAFIM','imagen' => 'img/logos/le sserafim.jpg','descripcion' => 'Grupo femenino de SOURCE MUSIC y HYBE, debutó en 2022.','link' => 'https://www.youtube.com/@LESSERAFIM_official'],
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

{{-- SECCIÓN DE MERCANCÍA --}}
<div class="artist-section">
    <h2>Mercancía oficial de los grupos</h2>
    <div class="row justify-content-center">

        @php
            $grupos_merch = [
                [
                    'nombre' => 'Blackpink',
                    'imagen' => 'img/logos/lamparabp.jpg.',
                    'descripcion' => 'Encuentra el merch oficial de Blackpink.',
                    'link' => 'https://shop.weverse.io/es/shop/MXN/artists/32'
                ],
                [
                    'nombre' => 'Stray Kids',
                    'imagen' => 'img/logos/lamparaskz1.jpg',
                    'descripcion' => 'Explora la colección oficial de Stray Kids.',
                    'link' => 'https://en.thejypshop.com/category/merch/35/'
                ],
                [
                    'nombre' => 'BTS',
                    'imagen' => 'img/logos/btslampara.jpg',
                    'descripcion' => 'Descubre la amplia gama de merch de BTS.',
                    'link' => 'https://shop.weverse.io/es/shop/MXN/artists/2'
                ],
                [
                    'nombre' => 'LE SSERAFIM',
                    'imagen' => 'img/logos/lamparalesserafim.jpg',
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
</div>


{{-- NOTICIAS --}}
<div class="contact-section">
    <h2>¿Quieres Saber Más?</h2>
    <p>Descubre noticias, eventos y más sobre tus artistas KPOP favoritos.</p>
    <div class="artist-section">
    <div class="row justify-content-center">

        @php
            $grupos_merch = [
                [
                    'nombre' => 'Blackpink',
                    'imagen' => 'img/logos/ot4.jpg.',
                    'descripcion' => 'Descubre noticias de BlackPink.',
                    'link' => 'https://www.vogue.mx/articulo/blackpink-biografia'
                ],
                [
                    'nombre' => 'Stray Kids',
                    'imagen' => 'img/logos/ot8.jpg',
                    'descripcion' => 'Descubre noticias de StrayKids.',
                    'link' => 'https://www.vogue.mx/articulo/stray-kids-todo-lo-que-debes-saber-banda-k-pop'
                ],
                [
                    'nombre' => 'BTS',
                    'imagen' => 'img/logos/ot7.jpg',
                    'descripcion' => 'Descubre noticias de BTS.',
                    'link' => 'https://www.vogue.mx/articulo/bts-anuncia-su-regreso-oficial-en-2026'
                ],
                [
                    'nombre' => 'LE SSERAFIM',
                    'imagen' => 'img/logos/ot5.jpg',
                    'descripcion' => 'Descubre noticias de Le sserafim.',
                    'link' => 'https://www.vogue.mx/articulo/le-sserafim-entrevista'
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
</div>



{{-- TESTIMONIOS --}}
<div class="testimonials">
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
</div>


{{-- FOOTER --}}
<div class="footer">
    <p>&copy; 2025 KPOP World. Todos los derechos reservados.</p>
    <div>
        <a href="https://www.youtube.com" target="_blank">YouTube</a> |
        <a href="https://www.instagram.com" target="_blank">Instagram</a> |
        <a href="https://weverse.io" target="_blank">Weverse</a>
    </div>
</div>

@endsection
