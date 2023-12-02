<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="agent" content="{{ checkAgent() }}">
    {{-- Các meta seo --}}
    @include('web.general.layouts.seo')
    {{-- Cấu hình Asset --}}
    <style>
		@php
			echo file_get_contents(asset('assets/fonts/Roboto/stylesheet.css?v='.config('Asset.vesion')));
			echo file_get_contents(asset('assets/build/css/general.min.css?v='.config('Asset.vesion')));
		@endphp
	</style>
</head>
<body>
    <section id="loading_box"><div id="loading_image"></div></section>
    <div id="toast-container" class="toast-top-right" style="display: none;">
        <div class="toast" aria-live="assertive" style="">
            <div class="toast-message"></div>
        </div>
    </div>
    @include('web.general.layouts.components.backtop')
    @yield('content')
    <script src="{{ asset('assets/libs/jquery/jquery.min.js?v='.config('Asset.vesion'))}}"></script>
    <script src="{{asset('assets/libs/venobox/js/venobox.min.js?v='.config('SudoAsset.vesion'))}}"></script>
    <script src="{{asset('assets/build/js/general.min.js?v='.config('Asset.vesion'))}}"></script>
</body>
</html>