@extends('web.layout.app')
@section('head')
	<style>
		@php
			echo file_get_contents(asset("/assets/build/css/home.min.css?v=".config('SudoAsset.vesion')));
		@endphp
	</style>
@endsection
@section('content')
	<h1>đặng hữu tiến</h1>
@endsection