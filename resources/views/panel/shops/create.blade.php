@extends('panel.layout.master' , ['title' => 'اضافة متجر'])


@push('css')
    <link href="{{asset('panelAssets/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')

    {!! Form::open(['method'=>isset($item) ? 'PUT' : 'POST', 'url'=> url()->current() ,'to'=> route('panel.shops.index') ,  'class'=>'form-horizontal','id'=>'form']) !!}

        @csrf
        <div class="row">

            <div class="col-md-8">
                <div class="kt-portlet kt-portlet--tabs">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x"
                                role="tablist">
                                @php $i=1; @endphp
                                @foreach(locales() as $key=>$language)
                                    <li class="nav-item">
                                        <a class="nav-link {{$i==1?'active':''}}" data-toggle="tab"
                                           href="#kt_tabs_{{$i}}" role="tab">
                                            {{__('translate.'.$key)}}
                                        </a>
                                    </li>
                                    @php $i++; @endphp

                                @endforeach


                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>رابط المتجر</label>
                            <input class="form-control m-input" type="text" name="url"
                                   placeholder="رابط المتجر" required value="{{ isset($item) ? $item->url : "" }}">
                        </div>


                        <div class="tab-content">
                            @php $i=1; @endphp
                            @foreach(locales() as $key=>$language)

                                <div class="tab-pane {{$i==1?'active':''}}" id="kt_tabs_{{$i}}" role="tabpanel">

                                    <div class="form-group">
                                        <label>الإسم</label>
                                        <input class="form-control m-input" type="text" name="{{ 'name_'.$key }}"
                                               placeholder="الإسم" required
                                               value="{{ isset($item) ? $item->getTranslation($key)->name : "" }}">
                                    </div>
                                </div>

                                @php $i++; @endphp

                            @endforeach

                        </div>
                    </div>
                </div>
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

                <div class="kt-portlet">
                    <div class="kt-portlet__body ">


                        <div class="form-group">
                            <label>ايقونة المتجر</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imgload" name="logo">
                                <label class="custom-file-label" for="imgload" id="imgload">Choose file</label>
                            </div>
                            <label>50x50</label>
                        </div>

                        <div class="img-responsive">
                            <div class="imageEditProfile text-center">
                                <img src="{{ isset($item) ? url('image/' . $item->logo)  : "" }}" alt="" id="imgshow" style="max-width: 100%">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="kt-portlet">
                    <div class="kt-portlet__body ">


                        <div class="form-group">
                            <label>شعار المتجر للكوبون</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imgload1" name="coupon_logo">
                                <label class="custom-file-label" for="imgload" id="imgload1">Choose file</label>
                            </div>
                            <label>120x70</label>
                        </div>

                        <div class="img-responsive">
                            <div class="imageEditProfile text-center">
                                <img src="{{ isset($item) ? url('image/' . $item->coupon_logo)  : "" }}" alt="" id="imgshow1" style="max-width: 100%">
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        {!! Form::close() !!}
@stop

@push('js')
    <script src="{{ asset('panelAssets/js/post.js') }}"></script>

    <script>
        $("#imgload").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgshow').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        $("#imgload1").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgshow1').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endpush
