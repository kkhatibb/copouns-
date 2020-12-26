@extends('panel.layout.master' , ['title' => 'إضافة مستخدم'])

@section('content_head')
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">إضافة مستخدم</h3>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <form class="kt-form" id="kt_form_1">
        @csrf
        <div class="row">

            <div class="col-md-8">

                <!--begin::Portlet-->
                <div class="kt-portlet">


                    <div class="kt-portlet__body">

                        <div class="form-group">
                            <label>الإسم</label>
                            <input class="form-control m-input" type="text" name="name" placeholder="الإسم">

                        </div>

                        <div class="form-group">
                            <label>البريد الإلكتروني</label>
                            <input class="form-control m-input" type="email" name="email"
                                   placeholder="البريد الإلكتروني">
                        </div>

                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input class="form-control m-input" type="password" name="password" id="password"
                                   placeholder="كلمة المرور">
                        </div>

                        <div class="form-group">
                            <label>تاكيد كلمة المرور</label>
                            <input class="form-control m-input" type="password" name="password_confirmation"
                                   placeholder="تاكيد كلمة المرور">
                        </div>


                    </div>

                </div>


            </div>

            <div class="col-lg-4">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label" style="width: 100%;">
                            <button type="submit" style="width: 100%;" id="save" class="btn btn-brand">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </form>

@endsection


@push('js')


    <script>

        var KTFormControls = function () {
            // Private functions

            var demo1 = function () {
                $("#kt_form_1").validate({
                    // define validation rules
                    rules: {
                        name: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 6
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password",
                        },
                    },

                    //display error alert on form submit
                    invalidHandler: function (event, validator) {
                        var alert = $('#kt_form_1_msg');
                        alert.removeClass('kt--hide').show();
                    },

                    submitHandler: function (form) {
                        form[0].submit(); // submit the form
                    }
                });
            }


            return {
                // public functions
                init: function () {
                    demo1();
                }
            };
        }();

        jQuery(document).ready(function () {
            KTFormControls.init();
        });

        $('#kt_form_1').submit(function (e) {
            e.preventDefault();
            if ($(this).valid()) {
                $('#save').attr('disabled', 'disabled')
                    .html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');

                var fd = new FormData(this);

                $.ajax({
                    url: "{{ route('panel.users.store') }}",
                    method: 'POST',
                    contentType: false,
                    processData: false,
                    data: fd,
                    success: function (response) {
                        $('#save').removeAttr('disabled').html('حفظ');
                        swal.fire({
                            type: 'success',
                            title: response.msg,
                            confirmButtonText: 'موافق'
                        }).then((result) => {
                            window.location = "{{ route('panel.users.index') }}";
                        });
                    },
                    error: function (response) {
                        $('#save').removeAttr('disabled').html('إضافة');
                        swal.fire(response.responseJSON.msg, "", "error");

                    }
                });

            }


        });
    </script>
@endpush
