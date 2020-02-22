<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title> @yield('title') - {{ config('app.name') }}</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
<div class="container">
@yield('content')
</div>
</body>
</html>