<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
@extends('layouts.app')
@push('scripts')
@endpush
@section('title')
    Página KPOP
@endsection
@section('content')

<script>
    
    document.addEventListener("DOMContentLoaded", () => {
        const sections = document.querySelectorAll(".fade-section");

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        sections.forEach(section => {
            observer.observe(section);
        });
    });
</script>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        scroll-behavior: smooth; 
    }

    
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
        padding: 10px 15px;
    }
    .navbar-nav .nav-link:hover {
        color: #FF1493 !important;
    }

    section, div[id] {
        scroll-margin-top: 80px; 
    }

    .hero-carousel img {
        height: 85vh;
        object-fit: cover;
        filter: brightness(80%);
    }
    .carousel-caption {
        bottom: 20%;
    }
    .carousel-caption h1 {
        font-size: 3.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
    }
    .carousel-caption p {
        font-size: 1.2rem;
        margin-top: 10px;
        text-shadow: 1px 1px 6px rgba(0,0,0,0.6);
    }

    
    .fade-section {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 1s ease-out, transform 1s ease-out;
    }
    .fade-section.visible {
        opacity: 1;
        transform: translateY(0);
    }

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

      
    .footer {
        background-color: #222;
        color: white;
        padding: 30px 20px;
        text-align: center;
    }
    .footer a {
        color: #FF1493;
        margin: 0 10px;
        text-decoration: none;1
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
        <li class="nav-item"><a class="nav-link" href="#preventa">Membresia oficial de grupos</a></li>
      </ul>
    </div>
  </div>
</nav>

{{-- CARRUSEL HERO --}}
<div id="heroCarousel" class="carousel slide carousel-fade hero-carousel" data-bs-ride="carousel" data-bs-interval="5000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('img/logos/ot4.jpg') }}" class="d-block w-100" alt="KPOP 1">  
      <div class="carousel-caption">
        <h1>Bienvenidos al Mundo del KPOP</h1>
        <p>Explora artistas, conciertos y más sobre tus grupos favoritos</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/logos/ot7.jpg') }}" alt="BTS">
      <div class="carousel-caption">
        <h1>Artistas Increíbles</h1>
        <p>Descubre BTS, BLACKPINK, LE SSERAFIM, STRAY KIDS y más</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/logos/ot5.jpg') }}" class="d-block w-100" alt="KPOP 3">
      <div class="carousel-caption">
        <h1>Conciertos y Merch</h1>
        <p>Todo lo que necesitas para vivir el KPOP al máximo</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

{{-- SECCIÓN DE ARTISTAS --}}
<section id="grupos" class="fade-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">🎤 Conoce a los Grupos</h2>
        <p class="text-center"><section class="artist-section">
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
</section></p>
    </div>
</section>

{{-- NOTICIAS --}}
<div id="noticias" class="fade-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">🎶 Conciertos.</h2>
        <p class="text-center"><div class="contact-section">
    <p>Aqui podras encontrar los proximos conciertos.</p>
    <div class="artist-section">
    <div class="row justify-content-center">

        @php
            $grupos_merch = [
                [
                    'nombre' => 'Blackpink',
                    'imagen' => 'img/logos/bpconcert.jpeg',
                    'descripcion' => 'Descubre el proximo concierto de BlackPink.',
                    'link' => 'https://www.ticketmaster.ca/blackpink-tickets/artist/2590072'
                ],
                [
                    'nombre' => 'Stray Kids',
                    'imagen' => 'img/logos/skz.jpg',
                    'descripcion' => 'Descubre el proximo concierto de StrayKids.',
                    'link' => 'https://www.ticketmaster.ca/stray-kids-tickets/artist/2593788'
                ],
                [
                    'nombre' => 'BTS',
                    'imagen' => 'img/logos/BTS.jpg',
                    'descripcion' => 'Descubre el proximo concierto de BTS.',
                    'link' => 'https://www.ticketmaster.ca/bts-tickets/artist/2110227'
                ],
                [
                    'nombre' => 'LE SSERAFIM',
                    'imagen' => 'img/logos/lesserafim.jpg',
                    'descripcion' => 'Descubre el proximo concierto de Le sserafim.',
                    'link' => 'https://www.ticketmaster.ca/le-sserafim-tickets/artist/3068703'
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
</p>
    </div>
</div>

{{-- SECCIÓN DE MERCANCÍA --}}
<div id="merch" class="fade-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">🛒 Mercancía oficial</h2>
        <p class="text-center"><div class="artist-section">
    <h2>Mercancía oficial de los grupos</h2>
    <p>Descubre noticias, eventos y más sobre tus artistas KPOP favoritos.</p>
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
</p>
    </div>
</div>

{{-- NOTICIAS --}}
<div id="noticias" class="fade-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">📰 Noticias</h2>
        <p class="text-center"><div class="contact-section">
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
</p>
    </div>
</div>

{{-- MEMBRESIAS DE LOS GRUPOS --}}
<div id="preventa" class="fade-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">🎟 Membresias de Grupos</h2>
        <p class="text-center">Información sobre membresias oficiales de los grupos.</p>
    <div class="contact-section">
    <div class="artist-section">
    <div class="row justify-content-center">

        @php
            $grupos_merch = [
                [
                    'nombre' => 'Blackpink',
                    'imagen' => 'img/logos/BLACKPINK-1.jpg',
                    'descripcion' => 'Membresía oficial de BlackPink.',
                    'link' => 'https://shop.weverse.io/es/shop/MXN/artists/32?categoryId=853'
                ],
                [
                    'nombre' => 'Stray Kids',
                    'imagen' => 'img/logos/SKZ-1.jpg',
                    'descripcion' => 'Membresía oficial de StrayKids.',
                    'link' => 'https://www.yes24.com/product/search?domain=BOOK&query=%25EC%258A%25A4%25ED%258A%25B8%25EB%25A0%2588%25EC%259D%25B4%25ED%2582%25A4%25EC%25A6%2588%2520%25EB%25A9%25A4%25EB%25B2%2584%25EC%258B%25AD'
                ],
                [
                    'nombre' => 'BTS',
                    'imagen' => 'img/logos/BTS-1.jpg',
                    'descripcion' => 'Membresía oficial de BTS.',
                    'link' => 'https://shop.weverse.io/es/shop/MXN/artists/2?categoryId=18'
                ],
                [
                    'nombre' => 'LE SSERAFIM',
                    'imagen' => 'img/logos/leseerafim-1.jpg',
                    'descripcion' => 'Membresía oficial de Le sserafim.',
                    'link' => 'https://shop.weverse.io/es/shop/MXN/artists/50?categoryId=1759'
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