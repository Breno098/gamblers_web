<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=RocknRoll+One&display=swap');
    * {
        font-family: 'RocknRoll One', sans-serif;
    }

    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }
</style>
</head>
<body>

    <table style="margin: 0; padding: 0; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0; padding: 0; width: 100%;">
                    <tr>
                        <td style="padding: 25px 0; text-align: center;">
                            <a href="{{ env('APP_URL') }}" style="display: inline-block;">
                                <img src="{{ asset('storage/avatar/' . $user->avatar) }}" alt="Avatar" style="height: 200px; width: 150px;">
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center; ">
                            <p style="font-size: 35px; padding: 10px 0 0; border-radius: 5px; color: #ff5722; display: block; width: 570px; margin: 0 auto">
                                E ai queridão, bora apostar?
                            <p>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center;">
                            <p style="font-size: 20px; padding: 10px 0 0; border-radius: 5px; color: #000; display: block; width: 570px; margin: 0 auto">
                                Hoje tem jogo da {{ implode(', da ', $competitions) }} e você vai ficar de bobeira?
                            <p>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center; ">
                            <p style="font-size: 35px; padding: 10px 0 0; border-radius: 5px; color: #ff5722; display: block; width: 570px; margin: 0 auto">
                               Se liga nos jogos de hoje
                            <p>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center; ">
                            <p style="font-size: 20px; border-radius: 5px; color: #000; display: block; width: 570px; margin: 0 auto">
                                e já clica no botão ai pra fazer sua aposta
                            <p>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center; ">
                            <a
                                href="{{ env('APP_URL') }}"
                                style="font-size: 25px; text-decoration: none; background: #ff5722; padding: 20px; border-radius: 5px; color: #000; display: block; width: 570px; margin: 0 auto;"
                                class='button_link'
                            >
                               Bora
                               <img src="{{ asset('storage/app/cursor.png') }}" alt="cursor" style="height: 50px; width: 50px; position: absolute">
                            <a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 25px 0; text-align: center;">
                            <hr style="text-decoration: none; background: #ff5722; display: block; width: 570px; margin: 0 auto"/>
                        </td>
                    </tr>

                    @foreach ($games as $game)
                        <tr style="background: rgba(0, 0, 0, 0.05)">
                            <td style="padding: 25px 0; text-align: center;">
                                <table style="background: #fff; margin: 10px auto; width: 570px; border-radius: 5px; padding: 10px">
                                    <tr style="border-bottom: 1px solid #ff5722;">
                                        <td style="width: 50%">
                                            <strong> {{ $game->competition->name }} <strong>
                                        </td>
                                        <td style="width: 50%">
                                            <strong> {{ Str::ucfirst($game->stage) }} <strong>
                                        </td>
                                    </tr>

                                    <tr style="height: 150px;">
                                        <td style="width: 50%">
                                            <img src="{{ asset('storage/teams/' . $game->teamHome->name_photo) }}" alt="TeamHome" style="height: 100px; width: 100px;">
                                        </td>
                                        <td style="width: 50%">
                                            <img src="{{ asset('storage/teams/' . $game->teamGuest->name_photo) }}" alt="teamGuest" style="height: 100px; width: 100px;">
                                        </td>
                                    </tr>
                                    <tr style="background-color:#ff5722; height: 50px;">
                                        <td style="width: 50%">
                                            <strong> {{ $game->teamHome->name }} <strong>
                                        </td>
                                        <td style="width: 50%">
                                            <strong> {{ $game->teamGuest->name }} <strong>
                                        </td>
                                    </tr>

                                    <tr style="height: 50px;">
                                        <td style="width: 50%">
                                            <strong> {{ $game->date->format('H:i') }} <strong>
                                        </td>
                                        <td style="width: 50%">
                                            <strong> {{ $game->stadium->name }} <strong>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 25px 0; text-align: center;">
                                <hr style="text-decoration: none; background: #ff5722; display: block; width: 570px; margin: 0 auto"/>
                            </td>
                        </tr>
                    @endforeach

                    {{-- <!-- Email Body -->
                    <tr>
                            <td class="body" width="100%" cellpadding="0" cellspacing="0">
                                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                    <!-- Body content -->
                                    <tr>
                                        <td>
                                            @foreach ($games as $game)

                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </td>
                    </tr> --}}

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
