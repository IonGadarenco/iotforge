<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

<title>{{ $page_title ?? __('string.site_name') }}</title>

<meta name="description" content="{{ __('string.site_name') }} - Administrare">
<meta name="author" content="pixelcave">
<meta name="robots" content="noindex, nofollow">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Open Graph Meta -->
<meta property="og:title" content="{{ __('string.site_name') }} - Administrare">
<meta property="og:site_name" content="OneUI">
<meta property="og:description" content="{{ __('string.site_name') }} - Administrare">
<meta property="og:type" content="website">
<meta property="og:url" content="">
<meta property="og:image" content="">
<!-- Icons -->
@yield('head')
<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon" />

<!-- Stylesheets -->
<!-- Fonts and OneUI framework -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

<link rel="stylesheet" id="css-main" href="{{ asset('admin_assets/css/oneui.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_assets/js/plugins/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
<link rel="stylesheet" href="{{ asset('admin_assets/js/plugins/dropzone/min/dropzone.min.css') }}">

<link rel="stylesheet" href="{{ asset('admin_assets/jquery-ui/jquery-ui.min.css') }}" />
<link rel="stylesheet"
    href="{{ asset('admin_assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_assets/css/my_clients_style.css') }}">
<link rel="stylesheet" href="{{ asset('admin_assets/gallery/gallery.css') }}">
<script src="{{ asset('admin_assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugins/ckeditor/samples/js/sample.js') }}"></script>
<link rel="stylesheet"
    href="{{ asset('admin_assets/js/plugins/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

@stack('styles')
<style>
    .content-header {
        position: relative;
        width: 100%;
        height: 220;
    }

    .content-header img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
