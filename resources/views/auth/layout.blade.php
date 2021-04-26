
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Gamblers</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-light_green.min.css" /> <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_orange-green.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=RocknRoll+One&display=swap');

        * {
            overflow-x: hidden;
            margin: 0px;
            padding: 0px;
            font-family: 'RocknRoll One', sans-serif;
        }

        body {
            background: url({{ asset('storage/app/login_wallpaper.jpg')}}) center center / cover no-repeat fixed;
        }

        #login-fab {
            border-radius: 50%;
            height: 56px;
            margin: auto;
            min-width: 56px;
            width: 56px;
            overflow: hidden;
            background: rgba(158,158,158,.2);
            box-shadow: 0 1px 1.5px 0 rgba(0,0,0,.12), 0 1px 1px 0 rgba(0,0,0,.24);
            position: absolute;
            top: -30px;
            text-align: center;
            left: 0;
            right: 0;
        }
    </style>
</head>
<body>
    @yield('content')
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>
</html>
