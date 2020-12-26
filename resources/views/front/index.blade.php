@extends('front.layout.master')


@section('content')


    <header id="home" class="header-home">
        <div class="container">
            <div class="content-height row">
                <div class="content-height col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="content">
                        <div class="header-text"><h1>{{ getSetting('site_name_' . app()->getLocale())  }}</h1></div>
                        <div class="button"><a class="btn-main" href="#download">@lang('front.download')</a></div>
                    </div>
                </div>
                <div class="mock-header col-lg-6 col-md-6 col-sm-8 col-xs-12">
                    <div class="mock">
                        @if (app()->isLocale('ar'))
                            <img src="{{ asset('frontAssets/img/background/mock-header-rtl.png') }}" alt="">
                        @else
                            <img src="{{ asset('frontAssets/img/background/mock-header.png') }}" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="header-elment">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                 x="0px" y="0px" viewBox="0 0 1920 1080" style="enable-background:new 0 0 1920 1080;"
                 xml:space="preserve"> <style
                    type="text/css"> .st0 {
                        fill: #FFFFFF;
                    }</style>
                <path class="st0"
                      d="M0,516.42L0,1080h1920V333l-142.25,449.44c-47.14,148.92-206.08,231.44-355,184.3L0,516.42z"/> </svg>
        </div>
    </header>

    <section id="about" class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="mock-about"><img src="{{ url('image/' . @$about->image . '/') }}" alt="mock"></div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="about-text"><h2> {{ @$about->title }}</h2>
                        <p class="p-first">
                            {!! @$about->content !!}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="features section-padding">
        <div class="container">
            <div class="title "><h2>{{ __('front.shops') }}</h2>

                <div class="row">


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="features-items">
                            <div class="row " style="margin-top: 20px;">


                                @foreach($shops as $shop)
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <a href="{{ $shop->url }}" target="_blank">
                                            <div class="item text-center">
                                                <div class="item-icon">
                                                    <img src="{{ url('image/' . $shop->logo . '/80x80') }}" alt="mock">
                                                </div>
                                                <div class="item-text">
                                                    <h3>{{ $shop->name }}</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="download" class="download section-padding">
        <div class="container">
            <div class="row">
                <div class="mock-float col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="mock-section mock-float"><img src="{{ url('image/' . @$download->image . '/') }}"
                                                              alt="mock"></div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="download-left">
                        <div class="download-text"><h2>{{ @$download->title }}</h2>
                            <p>
                                {!!  @$download->content  !!}
                            </p>
                        </div>
                        <div class="download-badge">
                            <a class="store" href="{{ getSetting('appstore') }}">
                                <img src="{{ asset('frontAssets/img/badge/app-store.png') }}" alt="store">
                            </a>
                            <a class="play" href="{{ getSetting('googleplay') }}">
                                <img src="{{ asset('frontAssets/img/badge/google-play.png') }}" alt="play">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
