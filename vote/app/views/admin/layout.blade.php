<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=yes;">
    <title>投票后台管理</title>
    {{ HTML::style('/dist/css/bootstrap.min.css') }}
    {{ HTML::style('/css/admin.css') }}
</head>
<body>

@if (Session::has('message'))
<div class="alert alert-info container">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ Session::get('message') }}
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-warning container">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ Session::get('error') }}
</div>
@endif

@yield('content')

{{ HTML::script('/js/jquery-1.11.1.min.js'); }}
{{ HTML::script('/dist/js/bootstrap.min.js'); }}
</body>
</html>