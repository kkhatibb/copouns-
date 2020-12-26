@extends('front.layout.master')


@section('content')


    <header class="header-home header-blog header-single-blog">
        <div class="container">
            <div class="header-blog-title"><h1>{{ $page->title }}</h1></div>
        </div>
    </header>
    <section class="single-blog section-padding">
        <div class="container">
            <div class="row">
                <div class="single-blog-items">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="text-first">

                            <p>
                                {!! $page->content !!}
                            </p>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
