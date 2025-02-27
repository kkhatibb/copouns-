$(function () {
    'use strict';

    $('.collapsed').on('click', function () {
        $('.navbar-toggle').toggleClass('change');
    });
    $('a.click-close').on('click', function () {
        $('.navbar-collapse').collapse('hide');
    });
    $('body').scrollspy({target: ".navbar", offset: 72});
    $('a[href*="#"]').on('click', function (e) {
        $('html,body').animate({scrollTop: $($(this).attr('href')).offset().top - 71}, 800);
        e.preventDefault();
    });
    $('li').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
    });
    var scrollButton = $(".scroll-top");
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 400) {
            scrollButton.show();
        } else {
            scrollButton.hide();
        }
    });
    scrollButton.on('click', function () {
        $("html,body").animate({scrollTop: 0}, 2000);
    });
    $(".toggle-password").on('click', function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("data-toggle"));
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    $('.owl-carousel').owlCarousel({
        loop: true,
        center: true,
        margin: 0,
        dots: false,
        autoplay: true,
        nav: true,
        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        autoplayHoverPause: true,
        responsive: {991: {items: 3}, 767: {items: 1}, 480: {items: 1, nav: false}, 330: {items: 1}}
    });
});
$(function () {
    var Accordion = function (el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;
        var links = this.el.find('.drop-title');
        links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
    };
    Accordion.prototype.dropdown = function (e) {
        var $el = e.data.el, $this = $(this), $next = $this.next();
        $next.slideToggle();
        $this.parent().toggleClass('open');
        if (!e.data.multiple) {
            $el.find('.menu-text').not($next).slideUp().parent().removeClass('open');
        }
        ;
    }
    var accordion = new Accordion($('.accordion-list'), false);
});
