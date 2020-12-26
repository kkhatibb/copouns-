<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords"
          content="app, app landing, app landing page, agency, startup, saas, startup template, saas template, app, app template, app website, clean app landing, app landing, app landing template, business, creative, landing, marketing, product, software, software landing, Simple App Landing, webapp">
    <meta name="author" content="YasirKareem">
    <title>{{ getSetting('site_name_' . app()->getLocale()) }}</title>
    @if (app()->isLocale('ar'))
        <link rel="stylesheet" href="{{ asset('frontAssets/css/bootstrap.min-rtl.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('frontAssets/css/bootstrap.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('frontAssets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontAssets/css/bootstrap-dropdownhover.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontAssets/css/all.css') }}" >
    <link rel="stylesheet" href="{{ asset('frontAssets/css/flaticon.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700,900&amp;subset=arabic" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontAssets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontAssets/css/styles.css') }}">
    @if (app()->isLocale('ar'))
        <link rel="stylesheet" href="{{ asset('frontAssets/css/styles-rtl.css') }}">
    @endif
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontAssets/img/favicons/apple-touch-icon.png') }}">
</head>
