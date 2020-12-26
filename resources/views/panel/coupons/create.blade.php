@extends('panel.layout.master' , ['title' => 'اضافة كوبون'])


@push('css')
    <link href="{{asset('panelAssets/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('panelAssets/css/dropzone.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@section('content')

    {!! Form::open(['method'=>isset($item) ? 'PUT' : 'POST', 'url'=> url()->current() ,'to'=> route('panel.coupons.index') ,  'class'=>'form-horizontal','id'=>'form']) !!}

    <form class="kt-form" id="kt_form_1">
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
                            <label>الكوبون</label>
                            <input class="form-control m-input" type="text" name="coupon"
                                   placeholder="الكوبون" required value="{{ isset($item) ? $item->coupon : "" }}">
                        </div>


                        <div class="tab-content">
                            @php $i=1; @endphp
                            @foreach(locales() as $key=>$language)

                                <div class="tab-pane {{$i==1?'active':''}}" id="kt_tabs_{{$i}}" role="tabpanel">

                                    <div class="form-group">
                                        <label>وصف قصير</label>
                                        <input class="form-control m-input" type="text" name="{{ 'description_'.$key }}"
                                               placeholder="وصف قصير" required
                                               value="{{ isset($item) ? $item->getTranslation($key)->description : "" }}">
                                    </div>
                                </div>

                                @php $i++; @endphp

                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="kt-portlet">


                    <div class="kt-portlet__body">


                        <div class="form-group">
                            <input type="hidden" name="slider_images" id="images" value="">
                            <label>صور الكوبون</label>
                            <div>
                                <div class="dropzone dropzone-default dropzone-brand"
                                     id="dropzone1">
                                    <div class="dropzone-msg dz-message needsclick">
                                        <h3 class="dropzone-msg-title">أفلت الملفات هنا أو
                                            انقر للتحميل.</h3>
                                        <span class="dropzone-msg-desc">قم بتحميل ما يصل إلى 10 ملفات</span>
                                    </div>
                                </div>
                            </div>
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
                            <label>عدد مرات الاستخدام</label>
                            <input class="form-control m-input" type="number" name="numberOfUsage"
                                   placeholder="عدد مرات الاستخدام" required value="{{ isset($item) ? $item->numberOfUsage : "" }}">
                        </div>

                        <div class="form-group">
                            <label>المتجر</label>
                            <select class="form-control kt-selectpicker" name="shop_id">
                                @foreach(getShops() as $shop)
                                    <option value="{{ $shop->id }}" {{ isset($item) && $item->shop_id == $shop->id ? 'selected' : '' }}>{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>الفئة</label>
                            <select class="form-control kt-selectpicker" name="catagory_id">
                                @foreach(getCatagories() as $catagory)
                                    <option value="{{ $catagory->id }}"  {{ isset($item) && $item->catagory_id == $catagory->id ? 'selected' : '' }}>{{ $catagory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        {!! Form::close() !!}
        @stop

        @push('js')
            <script src="{{ asset('panelAssets/js/post.js') }}"></script>
            <script src="{{ asset('panelAssets/js/dropzone.js') }}" type="text/javascript"></script>
            <script src="{{ asset('panelAssets/js/dropzone.init.js') }}" type="text/javascript"></script>

            <script>
                $('.kt-selectpicker').selectpicker();
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


            <script>
                let images = [];
                "use strict";

                var KTDropzoneDemo = function () {
                    // Private functions
                    var demo1 = function () {
                        // multiple file upload
                        $('#dropzone1').dropzone({
                            url: "{{ url('panel/upload') }}", // Set the url for your upload script location
                            paramName: "file", // The name that will be used to transfer the file
                            maxFiles: 10,
                            maxFilesize: 10, // MB
                            acceptedFiles: "image/*",
                            addRemoveLinks: true,
                            dictRemoveFile: '<i class="fa fa-trash-alt"></i>',
                            removedfile: function (file) {
                                $.ajax({
                                    url: "{{ url('panel/delete') }}",
                                    method: "POST",
                                    data: {
                                        "id": file['sgName']
                                    },
                                    success: function (res) {
                                        var _ref;
                                        images.splice($.inArray(res.id, images), 1);
                                        $('#images').val(images);
                                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                                    }
                                })
                            },
                            accept: function (file, done) {
                                if (file.name == "justinbieber.jpg") {
                                    done("Naha, you don't.");
                                } else {
                                    done();
                                }
                            },
                            success: function (file, response) {
                                file['sgName'] = response.id;
                                images.push(response.id);
                                $('#images').val(images)
                            },
                            init: function () {
                                var myDropzone = this;
                                // console.log()
                                $.each({!! json_encode(@$item->sliderImages) !!}, function (key, value) {
                                    let file = {
                                        name: 'image/' + value.path,
                                        sgName: value.id,
                                        height: '320',
                                        width: '570',
                                        size: value.size,
                                    };
                                    images.push(value.id);
                                    myDropzone.options.addedfile.call(myDropzone, file);
                                    myDropzone.options.thumbnail.call(myDropzone, file, "{{ url('image/')}}/" + value.path + "/100x100");
                                    myDropzone.emit('complete', file);

                                });
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

                KTUtil.ready(function () {
                    KTDropzoneDemo.init();
                });

            </script>

    @endpush
