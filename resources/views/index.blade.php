<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="twitter:card" content="summary_large_image">
  <meta property="og:title" content="Photo Share" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{ url('/') }}/" />
  <meta property="og:image" content="{{ url('/') }}/photo-share-detail.png" />
  <meta property="og:description" content="You can share your favorite photos." />
  <meta property="og:locale" content="ja_JP" />

  <title>Photo Share</title>

  <!-- GoogleAnalytics -->
  <script type="text/javascript" src="https://www.google-analytics.com/analytics.js"></script>
  <script async src="//www.googletagmanager.com/gtag/js?id=UA-178135632-1"></script>
  <!-- app.js -->
  <script src="{{ mix('js/app.js') }}" defer></script>
  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/61fdc2f5c9.js" crossorigin="anonymous"></script>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- LightBox -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>

  <!-- Current Path -->
  <script>
    window.Laravel = {
      basePath: '{{ url('/') }}/'
    }
  </script>

  <!-- app.css -->
  @if(app('env') == 'production')
  <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
  @else
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @endif
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://unpkg.com/ionicons@4.2.2/dist/css/ionicons.min.css">
  <!-- LightBox -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css">
  <!-- AWS (S3) -->
  <link rel="stylesheet" href="https://hypertext-candy.s3-ap-northeast-1.amazonaws.com/posts/vue-laravel-tutorial/app.css">

</head>
<body>
  <div id="app"></div>
</body>
</html>