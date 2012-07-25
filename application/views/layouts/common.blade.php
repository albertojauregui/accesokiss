<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Laravel: A Framework For Web Artisans</title>
	<meta name="viewport" content="width=device-width">
	@section('assests')
		{{ HTML::style('laravel/css/style.css') }}
		{{ Asset::container('bootstrapper')->styles() }}
		{{ Asset::container('bootstrapper')->scripts() }}
	@yield_section
</head>
<body>
	<div class="container">
		@yield('content')
	</div>
</body>
</html>
