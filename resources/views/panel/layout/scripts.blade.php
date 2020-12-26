<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {};
</script>

<!--begin:: Vendor Plugins -->
<script src="{{ asset('panelAssets/js/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/popper.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/js.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/perfect-scrollbar.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/sticky.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/jquery.form.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/jquery.blockUI.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/owl.carousel.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/jquery.validate.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/additional-methods.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/jquery-validation.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/dashboard.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/sweetalert2.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/localization/messages_ar.min.js"
        integrity="sha256-EPgqOoVBNThJb8TtkiZe177cdDIaFu6CX7d5DzLCzZ4=" crossorigin="anonymous"></script>
<script src="{{ asset('panelAssets/js/summernote/dist/summernote.js') }}" type="text/javascript"></script>
<script src="{{ asset('panelAssets/js/summernote.min.js') }}" type="text/javascript"></script>

<script>
    $('.kt-selectpicker').selectpicker();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        swal.fire({
            title: "هل انت متاكد من هذه العملية",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'الغاء',
            confirmButtonText: 'نعم'
        }).then(function (result) {
            if (result.value) {

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        "_method": "Delete",
                    },
                    success: function (response) {
                        if (response.status) {
                            swal.fire({
                                type: 'success',
                                title: response.message,
                                confirmButtonText: 'موافق'
                            }).then(function (result) {
                                datatable.reload();
                            })
                        }else {
                            swal.fire({
                                type: 'error',
                                title: response.message,
                                text : response.errors_object,
                                confirmButtonText: 'موافق'
                            });
                        }
                    },
                });

            }
        });


    })

    $('.kt-portlet__body .dropdown-menu').on('click', '.deletes', function (e) {

        var checkedItems = [];
        $.each($(".kt-checkbox--solid input[type='checkbox']:checked").not('.kt-checkbox--all'), function () {
            if ($(this).parents('tr').find('.id').val() !== undefined ) {
                checkedItems.push($(this).parents('tr').find('.id').val());
            }
        });

        let url = $(this).data('url');
        if (checkedItems.length != 0) {
            swal.fire({
                title: 'هل انت متأكد من عملية الحذف',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'الغاء',
                confirmButtonText: 'نعم '
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: "post",
                        data: {ids: checkedItems},
                        success: function (response) {
                            swal.fire({
                                title: response.msg,
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'موافق',
                                dismiss: false
                            }).then(function (result) {
                                if (result.value) {
                                    location.reload();
                                } else {
                                    location.reload();
                                }
                            });
                        },
                        error : function (response) {
                            swal.fire(
                                response.responseJSON.msg, '','error'
                            );
                        }
                    });

                }
            });


        } else {
            swal.fire({
                title: 'يرجى اختيار على الأقل عنصر واحد للحذف',
                type: 'error',
                showCancelButton: false,
                confirmButtonText: 'موافق',
                dismiss: false
            }).then(function (result) {

            });
        }

    });



</script>
