<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('common.header')
</head>
<body>
<div class="container" style="padding:0;height:52px;border: solid 1px grey">
    @include('common.navbar')
</div>
<div class="container">
    <div class="row" style="margin-top: 15px;">
        <div class="col-sm-2" style="height:700px;border: solid 1px grey">
            @include('common.menu')
        </div>
        <div class="col-sm-10" style="height:700px;padding-right:0;">
            @yield('content')
        </div>
    </div>
</div>
<div class="container">
    @include('common.footer')
</div>
</body>
</html>