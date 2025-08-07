@extends('layouts.app')
@push('scripts')
@endpush
@section('title')
    Página KPOP
@endsection
@section('content')


<!DOCTYPE html>
<html lang='es'>
<head>
 <meta charset='UTF-8'>
<style>
 #cabecera{
 width: 100%;
 height: 500px;
 }
 #video {
 position: absolute;
 left: 0;
 top: 0;
 width: 100%;
 height: auto;
 z-index: -10;
 visibility: visible;
 }
 h2{
 color:white;
 text-shadow: 4px 4px 4px #333;
 text-align: center;
 margin-top: 200px;
 }
 </style> 
</head>
<body>
<div id='cabecera'>
 <video id='video' loop autoplay preload muted>
<source src='video.mp4' type='video/mp4; codecs='videoplayback.mp4'' />
<source src='video.ogg' type='video/ogg; codecs='theora,vorbis'' />
<source src='video.webm' type='video/webm; codecs='vp8,vorbis'' />
</video>
<h2>El texto lo podríamos poner en esta línea</h2>
</div>
<h4></h4>
</body>
</html>



@endsection
