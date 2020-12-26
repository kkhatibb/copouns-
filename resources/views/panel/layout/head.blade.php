<head>
	<base href="">
	<meta charset="utf-8"/>

	<meta name="description" content="Updates and statistics">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!--begin::Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">


	<!--begin:: Vendor Plugins -->
	<link href="{{ asset('panelAssets/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css"/>

	<link href="{{ asset('panelAssets/css/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('panelAssets/css/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('panelAssets/css/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('panelAssets/css/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('panelAssets/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('panelAssets/css/skins/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('panelAssets/css/skins/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('panelAssets/css/skins/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('panelAssets/css/skins/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('panelAssets/js/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('panelAssets/js/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css"/>

    @stack('css')

    <link href="{{ asset('panelAssets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('panelAssets/css/custom-style.css') }}" rel="stylesheet" type="text/css" />

	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
	<style>
		*{
			font-family: 'Cairo', sans-serif;
		}
        .bootstrap-select .dropdown-toggle .filter-option{
            text-align: right!important;
        }
        #kt_datepicker_1-error{
            display: none!important;
        }
        #kt_datepicker_2-error{
            display: none!important;
        }
	</style>

</head>
