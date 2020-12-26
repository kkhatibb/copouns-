@extends('panel.layout.master' , ['title' => 'تعديل مجموعة صلاحيات'])


@section('content_head')
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">تعديل مجموعة صلاحيات</h3>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <form class="kt-form" action="" method="post" id="kt_form_1">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-9">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                تعديل مجموعة صلاحيات
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->

                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>الإسم</label>
                            <input class="form-control m-input" type="text" name="name" placeholder="الإسم" value="{{ $role->name }}">
                        </div>
                        <div class="form-group">
                            <label>الوصف</label>
                            <textarea class="form-control m-input" type="text" name="description" placeholder="الوصف">{{ $role->description }}</textarea>
                        </div>

                        @include('panel.roles.permissions')

                    </div>


                    <!--end::Form-->
                </div>

                <!--end::Portlet-->

            </div>

            <div class="col-lg-3">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label"  style="width: 100%;">
                            <button type="submit"  style="width: 100%;" id="save" class="btn btn-brand">تعديل</button>
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
                        description: {
                            required: true,
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
            };


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

            $('#save').attr('disabled', 'disabled')
                .html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');

            var fd = new FormData(this);


            $.ajax({
                url : "{{ route('panel.permission.update' , $role->id ) }}",
                method: 'POST',
                contentType: false,
                processData: false,
                data : fd,
                success : function (response) {
                    $('#save').removeAttr('disabled').html('تعديل');
                    swal.fire({
                        type: 'success',
                        title: response.msg,
                        confirmButtonText: 'موافق'
                    }).then((result) => {
                        window.location = "{{ route('panel.permission.index') }}";
                    });
                },
                error: function (response) {
                    $('#save').removeAttr('disabled').html('تعديل');
                    swal.fire(response.responseJSON.msg, "", "error");

                }
            });


        });

        $(".checkAll").click(function () {
            $(this).closest('.form-group').find('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>


@endpush
