@extends('layouts.app')

@push('styles')
<style>
    /* Video de fondo */
    #video {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: auto;
        z-index: -10;
        object-fit: cover;
    }

    .hero-section {
        background: linear-gradient(to bottom right, #FFFDD0, #FADADD);
        color: #6A0DAD;
        text-align: center;
        padding: 100px 20px;
        position: relative;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
        color: #6A0DAD;
        font-weight: bold;
    }

    .card {
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 15px;
        overflow: hidden;
    }

    .card img {
        width: 100%;
        height: auto;
    }
</style>
@endpush

@section('title', 'Página KPOP')

@section('content')

    <!-- Sección Hero con video -->
    <div class="hero-section">
        <video id="video" autoplay loop muted playsinline>
            <source src="{{ asset('videoplayback.mp4') }}" type="video/mp4">
            Tu navegador no soporta videos en HTML5.
        </video>
        <h1>Bienvenido al Mundo KPOP</h1>
        <p>Explora artistas, conciertos, mercancía y más</p>
    </div>

    <!-- Artistas -->
    <div class="container py-5">
        <h2 class="section-title">Artistas</h2>
        <div class="row g-4">
           @php
            $grupos = [
                [
                    'nombre' => 'Blackpink',
                    'imagen' => 'img/logos/descarga (1).png',
                    'descripcion' => 'Grupo femenino de YG Entertainment, debutó en 2016.',
                    'link' => 'https://www.youtube.com/BlackpinkOfficial'
                ],
                [
                    'nombre' => 'Stray Kids',
                    'imagen' => 'img/logos/skz.png',
                    'descripcion' => 'Grupo masculino de JYP Entertainment, debut oficial en 2018.',
                    'link' => 'https://www.youtube.com/jypentertainment'
                ],
                [
                    'nombre' => 'BTS',
                    'imagen' => 'img/logos/BANANA_BTS_ARMY_LOGO.png',
                    'descripcion' => 'Debutó en 2013 con Big Hit. Alcanzaron fama global rápidamente.',
                    'link' => 'https://www.youtube.com/BANGTANTV'
                ],
                [
                    'nombre' => 'LE SSERAFIM',
                    'imagen' => 'img/logos/le sserafim.jpg',
                    'descripcion' => 'Grupo femenino de SOURCE MUSIC y HYBE, debutó en 2022.',
                    'link' => 'https://www.youtube.com/@LESSERAFIM_official'
                ],
            ];
        @endphp
            
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <a href="{{ $artista['link'] }}" target="_blank">
                            <img src="{{ asset($artista['imagen']) }}" alt="{{ $artista['nombre'] }}">
                        </a>
                        <div class="p-3 text-center">
                            <h5>{{ $artista['nombre'] }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Conciertos -->
    <div class="container py-5">
        <h2 class="section-title">Próximos Conciertos</h2>
        <div class="row g-4">
             @php
            $conciertos = [
                [
                    'grupo' => 'Blackpink',
                    'titulo' => 'BLACKPINK WORLD TOUR DEADLINE',
                    'imagen' => 'img/logos/bpconcert.jpeg',
                    'fecha' => '16 de Agosto, 2025',
                    'lugar' => 'London, GBWembley Stadium',
                    'link' => 'https://www.ticketmaster.co.uk/blackpink-world-tour-deadline-in-london-london-16-08-2025/event/230062588C620A64'
                ],
                [

                    'grupo' => 'Stray Kids',                    
                    'titulo' => 'Stray Kids World Tour dominATE',
                    'imagen' => 'img/logos/skz.jpg',
                    'fecha' => '30 de Julio, 2025',
                    'lugar' => 'Stadio Olimpico di Roma',
                    'link' => 'https://shop.ticketmaster.it/biglietti/stray-kids-world-tour-3cdominate-rome3e-30-luglio-2025-stadio-olimpico-di-roma-roma-11607.html'
                ],
                [
                    'grupo' => 'BTS',
                    'titulo' => 'BTS: PERMISSION TO DANCE ON STAGE',
                    'imagen' => 'img/logos/BTS.jpg',
                    'fecha' => '10 de Marzo, 2026',
                    'lugar' => 'Foro Sol, México',
                    'link' => 'https://www.ticketmaster.ca/bts-tickets/artist/2110227'
                ],
                [
                    'grupo' => 'LE SSERAFIM',
                    'titulo' => 'LE SSERAFIM - 2025 EASY CRAZY HOT TOUR',
                    'imagen' => 'img/logos/lesserafim.jpg',
                    'fecha' => '5 de Febrero, 2026',
                    'lugar' => 'Seattle, WA, USClimate Pledge Arena',
                    'link' => 'https://www.ticketmaster.com/le-sserafim-2025-easy-crazy-hot-seattle-washington-09-17-2025/event/0F0062C9F4123FFD?currency-locale=en-ca&_gl=1*1b7sl6e*_gcl_au*MzI1MTg5NzczLjE3NTMzNzY4MDQ.*_ga*MTg5MTE1NDA3MS4xNzUzMzc2ODAz*_ga_C1T806G4DF*czE3NTMzNzY4MDIkbzEkZzEkdDE3NTMzNzc4NzAkajM2JGwwJGgw*_ga_H1KKSGW33X*czE3NTMzNzY4MDIkbzEkZzEkdDE3NTMzNzc4NzAkajM2JGwwJGgw&_ga=2.90727962.1267877708.1753376803-1891154071.1753376803'
                ],
            ];
        @endphp

                <div class="col-lg-3 col-md-6">
                    <div class="card p-3 text-center">
                        <h5>{{ $c['grupo'] }}</h5>
                        <p>{{ $c['fecha'] }}</p>
                        <p>{{ $c['lugar'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Mercancía -->
    <div class="container py-5">
        <h2 class="section-title">Mercancía Oficial</h2>
        <div class="row g-4">
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
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <a href="{{ $gm['link'] }}" target="_blank">
                            <img src="{{ asset($gm['imagen']) }}" alt="{{ $gm['nombre'] }}">
                        </a>
                        <div class="p-3 text-center">
                            <h5>{{ $gm['nombre'] }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Noticias -->
    <div class="container py-5">
        <h2 class="section-title">Últimas Noticias</h2>
        <div class="row g-4">
            @php
            $grupos_merch = [
                [
                    'nombre' => 'Blackpink',
                    'imagen' => 'img/logos/ot4.jpg',
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

            
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <img src="{{ asset($gn['imagen']) }}" alt="{{ $gn['titulo'] }}">
                        <div class="p-3 text-center">
                            <p>{{ $gn['titulo'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
