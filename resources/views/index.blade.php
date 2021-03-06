<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Photo Share</title>
  <meta name="keyword" content="写真、共有">
  <meta name="description" content="当サイトのサービスを利用すれば、お気に入りの写真を共有できます。">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta property="og:title" content="Photo Share" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{ url('/') }}/" />
  <meta property="og:image" content="{{ url('/') }}/photo-share-top.png" />
  <meta property="og:site_name" content="{{ url('/') }}/">
  <meta property="og:description" content="当サイトのサービスを利用すれば、お気に入りの写真を共有できます。" />
  <meta property="og:locale" content="ja_JP" />
  <!-- Twitter Cards の設定 -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="{{ url('/') }}/">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-178225654-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-178225654-1');
  </script>
  <!-- app.js -->
  <script src="{{ mix('js/app.js') }}" defer></script>
  <!-- FontAwesome -->
  <script src="https://kit.fontawesome.com/61fdc2f5c9.js" crossorigin="anonymous"></script>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- LightBox -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js"></script>

  <!-- Current Path -->
  <script>
    window.Laravel = {
      basePath: '{{ url('/') }}/'
    }
  </script>

  <!-- app.css -->
  @if(app('env') == 'production')
  <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
  @else
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet">
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