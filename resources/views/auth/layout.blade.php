
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ asset('mdl/material.deep_orange-green.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=RocknRoll+One&display=swap');

        body {
            background: url({{ asset('storage/app/login_wallpaper.jpg')}}) center center / cover no-repeat fixed;
        }

        * {
            /* overflow-x: hidden; */
            margin: 0px;
            padding: 0px;
            font-family: 'RocknRoll One', sans-serif;
        }

    </style>
</head>
<body>
    <script src="{{ asset('mdl/material.min.js') }}"></script>
    @yield('content')
</body>
</html>
