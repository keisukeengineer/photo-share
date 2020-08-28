<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <!-- JS -->
  <script src="{{ mix('js/app.js') }}" defer></script>
  <script src="https://kit.fontawesome.com/61fdc2f5c9.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
  <script> window.Laravel={basePath: '{{url('/')}}/'}</script>

  <!-- CSS -->
  @if(app('env') == 'production')
  <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
  @else
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @endif
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather|Roboto:400">
  <link rel="stylesheet" href="https://unpkg.com/ionicons@4.2.2/dist/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css">
  <link rel="stylesheet" href="https://hypertext-candy.s3-ap-northeast-1.amazonaws.com/posts/vue-laravel-tutorial/app.css">

</head>
<body>
  <div id="app"></div>
</body>
</html>