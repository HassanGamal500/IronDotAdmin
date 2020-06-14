<!DOCTYPE html>
<html lang="en">
@include('common.meta')
<!--<body>-->
@if(App::isLocale('ar')) 
<body class="rtl">
@else
<body>
@endif

<div class="container-scroller">
    @include('common.nav')
    <div class="container-fluid page-body-wrapper">
        @include('common.sidebar')
        <div class="main-panel">
            @yield('content')
            @include('common.footer')
        </div>
    </div>
</div>

@include('common.script')
</body>
</html>
