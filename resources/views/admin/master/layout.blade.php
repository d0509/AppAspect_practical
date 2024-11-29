<!DOCTYPE html>
<html lang="en">

<head>

    @yield('contentHeader')
    @include('admin.includes.head')
</head>

<body>
    @include('admin.includes.header')

    @include('admin.includes.footer')

    @include('admin.includes.scripts')
    @yield('contentFooter')
</body>

</html>
