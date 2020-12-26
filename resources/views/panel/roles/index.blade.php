@extends('panel.layout.master' , ['title' => 'مجموعات الصلاحيات'])

@push('css')
    <link href="{{asset('panelAssets/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css"/>
@endpush


@section('content_head')
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">مجموعات الصلاحيات</h3>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand fa fa-lock"></i>
										</span>
                <h3 class="kt-portlet__head-title">
                    مجموعات الصلاحيات
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($roles)
                            @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{ $loop->index +1  }}</th>


                                    <td>{{ $role->name }}</td>


                                    <td>

                                        <div class="dropdown">
                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
                                                <i class="la la-cog"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('panel.permission.edit', $role->id) }}"><i class="la la-edit"></i> تعديل</a>
                                                <a class="dropdown-item delete" href="#" data-url="{{ route('panel.permission.destry' , $role->id) }}"><i class="la la-times"></i> حذف </a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                            @endforeach
                        @endif


                        </tbody>
                    </table>
                </div>
            </div>

            <!--end::Section-->

        </div>
    </div>

@endsection


