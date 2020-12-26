@extends('panel.layout.master' , ['title' => 'عرض الشكوى' ])

@push('css')
    <link href="{{ asset('panelAssets/js/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css"/>
@endpush


@section('content_head')
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">عرض الشكوى</h3>
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
                                        <span class="kt-widget1__desc">{{ $item->name }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">البريد الإلكتروني</h3>
                                        <span class="kt-widget1__desc">{{ $item->email }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">الوصف</h3>
                                        <span class="kt-widget1__desc">{{ $item->description }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">المتجر</h3>
                                        <span class="kt-widget1__desc">{{ $item->shop }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">الكوبون</h3>
                                        <span class="kt-widget1__desc">{{ $item->coupon }}</span>
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

        <div class="col-lg-12">

            <!--begin:: Widgets/Tasks -->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            الرد على الشكوى
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form class="kt-form" action="{{ route('panel.replay.store') }}" method="post" id="kt_form_1">

                        <input type="hidden" name="email" value="{{ $item->email }}">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea class="summernote form-control" style="display:none!important;" id="kt_summernote_1" name="message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="row">
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-success">ارسال رد</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!--end:: Widgets/Tasks -->
        </div>

    </div>




@endsection

@push('js')
    <script src="{{ asset('panelAssets/js/summernote/dist/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panelAssets/js/summernote.min.js') }}" type="text/javascript"></script>


    <script>

        var KTFormControls = function () {
            // Private functions

            var demo1 = function () {
                $( "#kt_form_1" ).validate({
                    // define validation rules
                    rules: {
                        message: {
                            required: true,
                        },
                    },

                    //display error alert on form submit
                    invalidHandler: function(event, validator) {
                        var alert = $('#kt_form_1_msg');
                        alert.removeClass('kt--hide').show();
                        // KTUtil.scrollTop();
                    },

                    submitHandler: function (form) {
                        form[0].submit(); // submit the form
                    }
                });
            }




            return {
                // public functions
                init: function() {
                    demo1();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTFormControls.init();
        });


        $(document).on('submit', '#kt_form_1', function (e) {

            e.preventDefault();

            var fd = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data:fd,
                contentType: false,
                processData: false,
                success :function (response) {
                    swal.fire({
                        title: response.msg,
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'اغلاق',
                        dismiss: false
                    }).then(function (result) {
                        location.reload();
                    });
                },
                error : function (response) {
                    swal.fire({
                        title: response.responseJSON.msg,
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'اغلاق',
                        dismiss: false
                    });
                }
            });
        });
    </script>

@endpush
