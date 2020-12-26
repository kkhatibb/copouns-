@extends('panel.layout.master' , ['title' => $title])

@push('css')
    <link href="{{ asset('panelAssets/js/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('panelAssets/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')

    {!! Form::open(['method'=>isset($item) ? 'PUT' : 'POST', 'url'=> url()->current() ,'to'=> url()->current() ,  'class'=>'form-horizontal','id'=>'form']) !!}

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



                        <div class="tab-content">
                            @php $i=1; @endphp
                            @foreach(locales() as $key=>$language)

                                <div class="tab-pane {{$i==1?'active':''}}" id="kt_tabs_{{$i}}" role="tabpanel">


                                    <div class="form-group">
                                        <label> العنوان </label>
                                        <input class="form-control m-input" type="text" name="{{ 'title_'.$key }}"
                                               placeholder="" required value="{{ isset($item) ? $item->getTranslation($key)->title : "" }}">

                                    </div>
                                    <div class="form-group">
                                        <label>الوصف</label>
                                        <textarea class="summernote form-control" style="display:none!important;" id="kt_summernote_1"
                                                  name="{{ 'description_'.$key }}" required placeholder="">{{ isset($item) ? $item->getTranslation($key)->description : ""  }}</textarea>
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
                                @lang('حفظ')
                            </button>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet">
                    <div class="kt-portlet__body ">

                        <div class="form-group">
                            <div class="kt-checkbox-list">
                                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                                    <input name="visible" type="checkbox" {{ isset($item) && $item->visible ? 'checked': '' }} > الظهور في الموقع
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label> عدد مرات المشاهدة </label>
                            <input class="form-control m-input" type="number" name="{{ 'numOfViews' }}" min="0"
                                   placeholder="" required value="{{ isset($item) ? $item->numOfViews : "0" }}">

                        </div>


                    </div>
                </div>

                <div class="kt-portlet">
                    <div class="kt-portlet__body ">


                        <div class="form-group">
                            <label>الصورة</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imgload" name="image">
                                <label class="custom-file-label" for="imgload" id="imgload">Choose file</label>
                            </div>
                        </div>

                        <div class="img-responsive">
                            <div class="imageEditProfile text-center">
                                <img src="{{ isset($item) ? url('image/' . $item->image)  : "" }}" alt="" id="imgshow" style="max-width: 100%">
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        {!! Form::close() !!}
@stop

@push('js')
    <script src="{{ asset('panelAssets/js/summernote/dist/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('panelAssets/js/summernote.min.js') }}" type="text/javascript"></script>
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
    </script>
@endpush
