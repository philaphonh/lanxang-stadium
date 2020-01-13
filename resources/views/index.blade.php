<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Philaphonh Inthavongsa">
    <meta name="description" content="The best football stadium in Laos">
    <meta name="csrf" content="{{ csrf_token() }}">
    <style>
        /** Font Face */
        @font-face {
            font-family: "Noto Sans";
            font-weight: 400;
            src: url("{{ asset('fonts/NotoSans-Regular.woff2') }}");
        }
        @font-face {
            font-family: "Noto Sans";
            font-weight: 300;
            src: url("{{ asset('fonts/NotoSans-Light.woff2') }}");
        }
        @font-face {
            font-family: "Noto Sans";
            font-weight: 200;
            src: url("{{ asset('fonts/NotoSans-Thin.woff2') }}");
        }
        @font-face {
            font-family: "Noto Sans";
            font-weight: 400;
            src: url("{{ asset('fonts/NotoSansLao-Regular.woff2') }}");
        }
        @font-face {
            font-family: "Noto Sans";
            font-weight: 300;
            src: url("{{ asset('fonts/NotoSansLao-Light.woff2') }}");
        }
        @font-face {
            font-family: "Noto Sans";
            font-weight: 200;
            src: url("{{ asset('fonts/NotoSansLao-Thin.woff2') }}");
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Football Stadium</title>
</head>

<body>

    <div id="app">
        <header>
            <Navbar></Navbar>
            <Banner></Banner>
        </header>
        <main id="container" class="flex flex-col min-h-screen bg-gray-200">
            <router-view></router-view>
        </main>
        <Footerr></Footerr>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
