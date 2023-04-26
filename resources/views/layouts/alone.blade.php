<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>3b - Soluciones</title>

    {{-- <style>
        body {
            background-image: url("{{ Storage::url('background.png') }}");
            background-size: cover;
            background-repeat: no-repeat;

        }
    </style> --}}

    <style>
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logo img {
            width: 200px;
        }

        body {
            overflow-y: hidden;
        }
    </style>

</head>

<body>

    <div class="logo">
        <img src="{{ Storage::url('logo.png') }}" alt="">
    </div>

</body>

</html>
