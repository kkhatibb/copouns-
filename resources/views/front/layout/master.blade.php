<!DOCTYPE html>
<html dir="{{ app()->isLocale('ar')? 'rtl' : 'ltr' }}" lang="{{ app()->getLocale() }}">
@include('front.layout.head')
<body>
@include('front.layout.nav')

@yield('content')

<footer class="section-padding">
    <div class="container">
        <div class="footer-logo"><img src="{{ asset('frontAssets/img/logo/logo.png') }}" alt="logo"></div>
    </div>
</footer>

<div class="scroll-top"><span class="animated fadeInRight"><i class="fas fa-chevron-up"></i></span></div>

@include('front.layout.scripts')
</body>

</html>
