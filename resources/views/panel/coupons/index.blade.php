@extends('panel.layout.master' , ['title' => 'الكوبونات'])


@push('css')
    <link href="{{asset('panelAssets/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('panelAssets/css/fancybox.min.css')}}" rel="stylesheet" type="text/css"/>

@endpush


@section('content_head')
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">الكوبونات</h3>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    المتاجر
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ route('panel.coupons.create')}}"
                           class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                                اضافة كوبون
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">


        <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control"
                                           placeholder="بحث..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!--begin: Datatable -->
            <div class="kt-datatable text-center" id="ajax_data"></div>

            <!--end: Datatable -->
        </div>
    </div>
@endsection

@push('js')

    <script src="{{asset('panelAssets/js/jquery.dataTables.js')}}" type="text/javascript"></script>
    <script src={{asset('panelAssets/js/data-ajax.js')}}  type="text/javascript"></script>
    <script src={{asset('panelAssets/js/fancybox.min.js')}}  type="text/javascript"></script>


    <script>

        window.data_url = '{{ route('panel.coupons.datatable') }}';

        window.columns = [
            {
                field: 'coupon',
                title: "كوبون الخصم",
                'class': "text-center",
                textAlign: "center",
            },
            {
                field: 'description',
                title: "وصف قصير",
                textAlign: "center",
                template: function (data) {
                    return data.description;
                }
            },
            {
                field: 'shop',
                title: "المتجر",
                textAlign: "center",
                template: function (data) {
                    return data.shop.name;
                }
            },
            {
                field: 'catagory',
                title: "الفئة",
                textAlign: "center",
                template: function (data) {
                    return data.catagory.name;
                }
            },
            {
                field: 'numberOfUsage',
                title: "عدد مرات الاستخدام",
                textAlign: "center",
            },
            {
                field: 'updated_at',
                title: "اخر استخدام",
                textAlign: "center",
            },
            {
                field: 'Actions',
                title: "العمليات",
                sortable: false,
                overflow: 'visible',
                textAlign: "center",
                autoHide: false,
                width: 210,
                template: function (data) {
                    var url = "{{ url('panel/coupons/') }}/" + data.id + "/edit";
                    var deleteUrl = "{{ url('panel/coupons/') }}/" + data.id;

                    return `
                        <input value=` + data.id + ` type="hidden" class="id">
						<div class="dropdown">
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
                                <i class="la la-cog"></i>
                            </a>
						  	<div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="`+ url +`">
                                        <i class="la la-edit"></i> تعديل
                                    </a>
                                    <a class="dropdown-item delete" href="#" data-url="` + deleteUrl + `"><i class="la la-times"></i> حذف</a>
						  	</div>
						</div>`;
                },
            }
        ];

    </script>

@endpush
