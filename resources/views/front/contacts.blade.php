<!DOCTYPE html>
<html lang="en">


@include('front.layout.head')
<body>
@include('front.layout.nav')


<header class="sign-up log-in">
    <div class="bg"><img class="wave-purple" src="{{ asset('frontAssets/img/background/sign-bg-01.svg') }}" alt=""></div>
    <div class="sign-up-content">
        <div class="container">
            <div class="row">

                <div class="form-trial col-lg-5 col-md-5 col-sm-8 col-xs-12">

                    <form action="{{ url()->current() }}" method="post">
                        @csrf
                        <h3>@lang('front.contacts')</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="name">
                            <input type="text" name="name" required placeholder="@lang('validation.attributes.name')">
                        </div>
                        <div class="name">
                            <input type="email" name="email" required placeholder="@lang('validation.attributes.email')">
                        </div>

                        <div class="name">
                            <input type="text" name="phone" required placeholder="@lang('validation.attributes.phone')">
                        </div>

                        <div class="subject">
                            <input type="text" name="subject" required placeholder="@lang('validation.attributes.subject')">
                        </div>
                        <div class="subject">
                            <textarea rows="3" name="message" required placeholder="@lang('validation.attributes.message')"></textarea>
                        </div>

                        <div class="submit">
                            <button class="form-submit" name="submit">@lang('front.send')</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@include('front.layout.scripts')
</body>

</html>
