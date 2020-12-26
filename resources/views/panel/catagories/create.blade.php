@extends('panel.layout.master' , ['title' => 'اضافة فئة'])


@push('css')
    <link href="{{asset('panelAssets/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')

    {!! Form::open(['method'=>isset($item) ? 'PUT' : 'POST', 'url'=> url()->current() ,'to'=> route('panel.catagories.index') ,  'class'=>'form-horizontal','id'=>'form']) !!}

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

            </div>
        </div>
        {!! Form::close() !!}
@stop

@push('js')
    <script src="{{ asset('panelAssets/js/post.js') }}"></script>
@endpush
