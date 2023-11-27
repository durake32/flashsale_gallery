<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dailomaa</title>

     <meta name='description' itemprop='description' content="Dailomaa - Nepal's First Online Stationery Store "/>
    <meta name='keywords' content="Dailomaa, Nepal's first online stationery store, offers all of your home, sporting, electronics, and cosmetic needs. Dailomaa is dedicated to providing multiple selections to people from various backgrounds (students to professionals) with an intuitive platform." />

    <meta property="og:description" content="Dailomaa, Nepal's first online stationery store, offers all of your home, sporting, electronics, and cosmetic needs. Dailomaa is dedicated to providing multiple selections to people from various backgrounds (students to professionals) with an intuitive platform." />

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('Asset/Frontend/css/bootstrap.min.css') }}" rel="stylesheet">


    <link rel="icon" type="image/png" href="{{ asset('Asset/Uploads/Logo/logo.png') }}" />
    <!-- self -->
    <link href="{{ asset('Asset/Frontend/css/image-hover.css') }}" rel="stylesheet">
    <link href="{{ asset('Asset/Frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('Asset/Frontend/css/responsive-tabs.css') }}" rel="stylesheet">
    <link href="{{ asset('Asset/Frontend/css/flexslider.css') }}" rel="stylesheet">
    <link href="{{ asset('Asset/Frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('Asset/Frontend/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Asset/Frontend/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Asset/Frontend/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TWQLV7HXGL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-TWQLV7HXGL');
</script>
@yield('style')
</head>