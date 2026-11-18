<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Demensi Studio</title>
    <meta name="description" content="Panel admin sistem booking Demensi Studio">
    @include('Layouts.admin.css')
</head>

<body>
    {{-- Start Sidebar --}}
    @include('Layouts.admin.sidebar')
    {{-- End Sidebar --}}

    <main class="main-wrapper">
        {{-- Start Header --}}
        @include('Layouts.admin.header')
        {{-- End Header --}}

        {{-- Start Main Konten --}}
        @yield('content')
        {{-- End Main Konten --}}

        {{-- Start Footer --}}
        @include('Layouts.admin.footer')
        {{-- End Footer --}}
    </main>

    {{-- Start Js --}}
    @include('Layouts.admin.js')
    {{-- End Js --}}
</body>

</html>
