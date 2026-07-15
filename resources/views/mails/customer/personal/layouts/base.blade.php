<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Customer' }}</title>
</head>


<body style=" margin:0; padding:0; background:#f4f4f4; font-family:Arial, Helvetica, sans-serif;">


    <table width="100%"
        cellpadding="0"
        cellspacing="0">

        <tr>
            <td align="center">


                <table width="600"
                    cellpadding="0"
                    cellspacing="0"
                    style="background:white; margin-top:40px; border-radius:8px; overflow:hidden;">
                </table>



        <tr>
            <td style=" background:#111827; padding:30px; text-align:center;">

                <h1 style=" color:white; margin:0;">
                    Il tuo profilo personale
                </h1>

            </td>
        </tr>



        <tr>
            <td style="padding:40px;">

                @yield('content')

            </td>
        </tr>



        <tr>
            <td style=" background:#f9fafb; padding:20px; text-align:center; font-size:12px; color:#6b7280;">

                © {{ date('Y') }} - La tua azienda

            </td>
        </tr>


    </table>


    </td>
    </tr>

    </table>


</body>

</html>