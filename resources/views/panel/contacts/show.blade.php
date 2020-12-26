@extends('panel.layout.master' , ['title' => 'عرض البريد الوارد' ])

@section('content_head')
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">عرض البريد الوارد</h3>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <!--Begin::Section-->
            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">


                        <div class="col-md-12 col-lg-12 col-xl-4">

                            <!--begin:: Widgets/Stats2-3 -->
                            <div class="kt-widget1">
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">الإسم</h3>
                                        <span class="kt-widget1__desc">{{ $contact->name }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">البريد الإلكتروني</h3>
                                        <span class="kt-widget1__desc">{{ $contact->email }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">رقم الجوال</h3>
                                        <span class="kt-widget1__desc">{{ $contact->phone }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">العنوان</h3>
                                        <span class="kt-widget1__desc">{{ $contact->subject }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">الرسالة</h3>
                                        <span class="kt-widget1__desc">{{ $contact->message }}</span>
                                    </div>
                                </div>
                            </div>

                            <!--end:: Widgets/Stats2-3 -->
                        </div>

                    </div>
                </div>
            </div>

            <!--End::Section-->

        </div>

    </div>




@endsection
