<script src="{{ asset('frontAssets/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontAssets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontAssets/js/bootstrap-dropdownhover.min.js') }}"></script>
<script src="{{ asset('frontAssets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontAssets/js/script.js') }}"></script>
<script>


    $(window).scroll(function () {
        if ($('.navbar').offset().top > 50) {
            $('.navbar-fixed-top').addClass('top-nav');
            $('.logo').html("<img class='navbar-brand' src='{{ asset('frontAssets/img/logo/logo-top.png')}}' alt='logo'>");
        } else {
            $('.navbar-fixed-top').removeClass('top-nav');
            $('.logo').html("<img class='navbar-brand' src='{{ asset('frontAssets/img/logo/logo.png')}}' alt='logo'>");
        }
    });

    $('.owl-carousel').owlCarousel({
        loop: true,
        center: true,
        margin: 0,
        rtl: true,
        dots: false,
        autoplay: true,
        nav: true,
        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        autoplayHoverPause: true,
        responsive: {991: {items: 3}, 767: {items: 1}, 480: {items: 1, nav: false}, 330: {items: 1}}
    });
</script>
