@extends('panel.layout.master' , ['title' => 'الإعدادات'])

@push('css')
    <link href="{{ asset('panelAssets') }}/js/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css"/>
@endpush
@section('content_head')
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">الإعدادات</h3>
            </div>
        </div>
    </div>

@endsection


@section('content')
    <form class="kt-form" action="{{ route('panel.settings.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-8">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tabs_5_1">
                                    الإعدادات الأساسية
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tabs_5_2">
                                    إعدادات التواصل
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tabs_5_3">
                                    إعدادات وسائل التواصل الإجتماعي
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tabs_5_4">
                                    التطبيقات
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_tabs_5_1" role="tabpanel">


                                <div class="form-group">
                                    <label>اسم الموقع بالعربية</label>
                                    <input type="text" name="site_name_ar"
                                           value="{{ App\Setting::getSetting('site_name_ar')->value }}"
                                           class="form-control"
                                           aria-describedby="emailHelp" placeholder="اسم الموقع بالعربية">
                                </div>

                                <div class="form-group">
                                    <label>اسم الموقع بالإنجليزية</label>
                                    <input type="text" name="site_name_en"
                                           value="{{ App\Setting::getSetting('site_name_en')->value }}"
                                           class="form-control"
                                           aria-describedby="emailHelp" placeholder="اسم الموقع بالإنجليزية">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">شعار الموقع</label>
                                    <div></div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/*" id="imgload"
                                               name="site_logo">
                                        <label class="custom-file-label" for="imgload">Choose file</label>
                                    </div>
                                    <div class="img-responsive">
                                        <div class="imageEditProfile text-center mt-3">
                                            <img
                                                @if ($value = getSetting('site_logo'))
                                                src="{{ asset('logo.png') }}"
                                                @endif
                                                alt="" id="imgshow" style="max-width: 30%">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>وصف الموقع</label>
                                    <textarea name="site_description" class="form-control" aria-describedby="emailHelp"
                                              placeholder="وصف الموقع">{{ App\Setting::getSetting('site_description')->value }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>الكلمات المفتاحية للموقع</label>
                                    <input id="kt_tagify_1" name='site_tags' placeholder='الكلمات المفتاحية للموقع ...'
                                           value='{{ App\Setting::getSetting('site_tags')->value }}'>

                                </div>


                            </div>
                            <div class="tab-pane" id="kt_tabs_5_2" role="tabpanel">

                                <div class="form-group">
                                    <label>البريد الالكتروني</label>
                                    <input type="email" name="email"
                                           value="{{ App\Setting::getSetting('email')->value }}" class="form-control"
                                           aria-describedby="emailHelp" placeholder="البريد الالكتروني">
                                </div>

                                <div class="form-group">
                                    <label>رقم الهاتف</label>
                                    <input type="text" name="phone"
                                           value="{{ App\Setting::getSetting('phone')->value }}" class="form-control"
                                           aria-describedby="emailHelp" placeholder="رقم الهاتف">
                                </div>


                            </div>

                            <div class="tab-pane" id="kt_tabs_5_3" role="tabpanel">

{{--                                <div class="form-group">--}}
{{--                                    <label>فيسبوك</label>--}}
{{--                                    <input type="text" name="facebook"--}}
{{--                                           value="{{ App\Setting::getSetting('facebook')->value }}" class="form-control"--}}
{{--                                           aria-describedby="emailHelp" placeholder="فيسبوك">--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label>تويتر</label>
                                    <input type="text" name="twitter"
                                           value="{{ App\Setting::getSetting('twitter')->value }}" class="form-control"
                                           aria-describedby="emailHelp" placeholder="تويتر">
                                </div>

                                <div class="form-group">
                                    <label>واتساب</label>
                                    <input type="text" name="whatsapp"
                                           value="{{ App\Setting::getSetting('whatsapp')->value }}" class="form-control"
                                           aria-describedby="emailHelp" placeholder="واتساب">
                                </div>
                                <div class="form-group">
                                    <label>إنستقرام</label>
                                    <input type="text" name="instagram"
                                           value="{{ App\Setting::getSetting('instagram')->value }}"
                                           class="form-control"
                                           aria-describedby="emailHelp" placeholder="إنستقرام">
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label>يوتيوب</label>--}}
{{--                                    <input type="text" name="youtube"--}}
{{--                                           value="{{ App\Setting::getSetting('youtube')->value }}" class="form-control"--}}
{{--                                           aria-describedby="emailHelp" placeholder="يوتيوب">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>فيمو</label>--}}
{{--                                    <input type="text" name="viemo"--}}
{{--                                           value="{{ App\Setting::getSetting('viemo')->value }}" class="form-control"--}}
{{--                                           aria-describedby="emailHelp" placeholder="فيمو">--}}
{{--                                </div>--}}

                            </div>
                            <div class="tab-pane" id="kt_tabs_5_4" role="tabpanel">

                                <div class="form-group">
                                    <label>اب ستور</label>
                                    <input type="text" name="appstore"
                                           value="{{ App\Setting::getSetting('appstore')->value }}" class="form-control"
                                           aria-describedby="emailHelp" placeholder="اب ستور">
                                </div>
                                <div class="form-group">
                                    <label>قوقل بلاي</label>
                                    <input type="text" name="googleplay"
                                           value="{{ App\Setting::getSetting('googleplay')->value }}" class="form-control"
                                           aria-describedby="emailHelp" placeholder="قوقل بلاي">
                                </div>






                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label" style="width: 100%;">
                            <button type="submit" style="width: 100%;" id="save"
                                    class="btn btn-brand">حفظ
                            </button>
                        </div>
                    </div>
                </div>
{{--                <div class="kt-portlet">--}}
{{--                    <div class="kt-portlet__body ">--}}

{{--                        <input type="hidden" id="startLat" name="latitude" value="{{ \App\Setting::getSetting('latitude')->value }}">--}}
{{--                        <input type="hidden" id="startLon" name="longitude" value="{{ \App\Setting::getSetting('longitude')->value }}">--}}

{{--                        <div id="map" style="height: 350px;"></div>--}}

{{--                    </div>--}}
{{--                </div>--}}
            </div>


        </div>

    </form>

@endsection

@push('js')
    <script src="{{ asset('panelAssets/js/@yaireo/tagify/dist/tagify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panelAssets/js/tagify.js') }}" type="text/javascript"></script>


{{--    <script src="https://maps.google.com/maps/api/js?key=AIzaSyAIiPJXATL1VQa0KhqL9eWDo834B6v9O2M" type="text/javascript"></script>--}}
{{--    <script src="{{ asset('panelAssets/js/gmaps.js') }}" type="text/javascript"></script>--}}

{{--    <script>--}}

{{--        $(document).ready(function () {--}}

{{--            var GoogleMapsDemo = {--}}
{{--                init: function () {--}}
{{--                    var location  = {lat: parseFloat( $('#startLat').val() ), lng: parseFloat($('#startLon').val()) };--}}
{{--                    map = new google.maps.Map(document.getElementById('map'), {--}}
{{--                        center: location,--}}
{{--                        zoom: 15,--}}
{{--                    });--}}
{{--                    var marker = new google.maps.Marker({--}}
{{--                        position: location,--}}
{{--                        map: map,--}}
{{--                        draggable:true,--}}
{{--                        animation: google.maps.Animation.DROP,--}}

{{--                    });--}}


{{--                    google.maps.event.addListener(marker, 'position_changed' , function () {--}}
{{--                        var lat = marker.getPosition().lat();--}}
{{--                        var lng = marker.getPosition().lng();--}}
{{--                        $('#startLon').val(lng);--}}
{{--                        $('#startLat').val(lat);--}}
{{--                    });--}}
{{--                }--}}
{{--            };--}}
{{--            jQuery(document).ready(function () {--}}
{{--                GoogleMapsDemo.init()--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}

    <script>
        $("#imgload").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgshow').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endpush
