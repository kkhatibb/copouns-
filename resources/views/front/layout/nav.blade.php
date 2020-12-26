<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <div class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false"
                 role="button">
                <div class="menu-icon">
                    <div class="toggle-bar "></div>
                </div>
            </div>
            <div class="logo"><img class="navbar-brand" src="{{ asset('frontAssets/img/logo/logo.png') }}" alt="logo">
            </div>
        </div>
        <div class="collapse navbar-collapse" id="menu" data-hover="dropdown" data-animations="fadeInUp">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a class="click-close" href="{{ url(app()->getLocale()) }}#home">{{ __('front.home') }}</a></li>
                <li><a class="click-close" href="#about">@lang('front.about')</a></li>
                <li><a class="click-close" href="#features">@lang('front.shops')</a></li>
                <li><a class="click-close" href="#download">{{ __('front.download') }}</a></li>
                <li><a class="click-close" href="{{ url(app()->getLocale() . '/privacy-policy') }}">{{ __('front.privacy') }}</a></li>
                <li><a class="click-close" href="{{ url(app()->getLocale() . '/contacts') }}">{{ __('front.contacts') }}</a></li>

                @if (app()->isLocale('ar'))
                    <li><a class="click-close sign-up" href="{{ url('lang/en') }}">EN</a></li>
                @else
                    <li><a class="click-close sign-up" href="{{ url('lang/ar') }}">AR</a></li>

                @endif

            </ul>
        </div>
    </div>
</nav>
