<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.tiny.cloud/1/4zpjg442gee06lozdjhx9e93of2vdiv453djr5th44yafy2v/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script src="{{ asset('js/app.js') }}" defer></script>
	
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div id="app">
		@include('shared.header')
		@auth
			@include('shared.aside')
		@endauth
		@auth
			<main>
		@else
			<main class="full">
		@endauth
			@yield('content')
		</main>
	</div>
</body>
</html>
