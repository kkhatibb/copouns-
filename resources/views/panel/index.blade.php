@extends('panel.layout.master' , ['title' => 'الرئيسية'])

@section('content_head')
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">لوحة التحكم</h3>
            </div>
        </div>
    </div>

@endsection


@section('content')
    <!--Begin::Row-->

    <div class="kt-portlet">
        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-lg">

                <div class="col-md-4  col-lg-6 col-xl-3">
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <h4 class="kt-widget24__title">
                                    عدد المستخدمين
                                </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-brand">{{ $users }}</span>
                        </div>

                        <div class="progress progress--sm">
                            <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="kt-widget24__action"></div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-6 col-xl-3">
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <h4 class="kt-widget24__title">
                                    عدد المتاجر
                                </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-warning">{{ $shops }}</span>
                        </div>
                        <div class="progress progress--sm">
                            <div class="progress-bar kt-bg-warning" role="progressbar" style="width: 84%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4  col-lg-6 col-xl-3">
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <h4 class="kt-widget24__title">
                                    عدد الكوبونات
                                </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-success">{{ $coupons }}</span>
                        </div>

                        <div class="progress progress--sm">
                            <div class="progress-bar kt-bg-success" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="kt-widget24__action"></div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-6 col-xl-3">
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <h4 class="kt-widget24__title">
                                    عدد الشكاوي
                                </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-danger">{{ $complaint }} </span>
                        </div>
                        <div class="progress progress--sm">
                            <div class="progress-bar kt-bg-danger" role="progressbar" style="width: 84%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4  col-lg-6 col-xl-3">
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <h4 class="kt-widget24__title">
                                    عدد اقتراحات الكوبونات
                                </h4>
                            </div>
                            <span class="kt-widget24__stats kt-font-success">{{ $suggestion }}</span>
                        </div>

                        <div class="progress progress--sm">
                            <div class="progress-bar kt-bg-success" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="kt-widget24__action"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--End::Row-->
@endsection
