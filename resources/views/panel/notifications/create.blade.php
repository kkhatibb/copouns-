@extends('panel.layout.master' , ['title' => 'الإشعارات'])

@push('css')
    <link href="{{asset('panelAssets/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content_head')
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">الإشعارات</h3>
            </div>
        </div>
    </div>

@endsection

@section('content')
    {!! Form::open(['method'=> 'POST', 'url'=> url()->current() ,'to'=> url()->current() ,  'class'=>'form-horizontal','id'=>'form']) !!}
        @csrf
        <div class="row">

            <div class="col-md-8">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                الإشعارات
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->

                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>العنوان</label>
                            <input class="form-control m-input" type="text" required name="title" placeholder="">

                        </div>
                        <div class="form-group">
                            <label>الوصف</label>
                            <textarea class="form-control m-input" type="text" required name="description"
                                      placeholder=""></textarea>
                        </div>


                        <div class="form-group">
                            <label>المتجر</label>
                            <select class="form-control kt-selectpicker"  name="shop_id">
                                @if($shops->count())
                                    <option value=" " disabled selected>أختيار المتجر</option>
                                    @foreach($shops as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                    </div>


                    <!--end::Form-->
                </div>

                <!--end::Portlet-->

            </div>

            <div class="col-lg-4">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label" style="width: 100%;">
                            <button type="submit" style="width: 100%;" id="m_login_signin_submit" class="btn btn-brand">
                                حفظ
                            </button>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    {!! Form::close() !!}

@endsection


@push('js')
    <script src="{{ asset('panelAssets/js/post.js') }}"></script>
@endpush
