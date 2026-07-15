@extends('emails.customer.personal.layouts.base')


@section('content')


<h2 style=" color:#111827;">
    Ciao {{ $customerName }},
</h2>

<p style=" font-size:16px; line-height:1.6; color:#374151;">
    il tuo profilo personale è stato creato correttamente.
</p>

<p style=" font-size:16px; line-height:1.6; color:#374151;">
    Da questo momento puoi accedere ai servizi disponibili.
</p>

<table width="100%" style="margin-top:30px">

    <tr>

        <td align="center">

            <a href="{{ $url }}" style="background:#2563eb; color:white; padding:14px 25px; text-decoration:none; border-radius:6px; display:inline-block;">
                Accedi al tuo profilo
            </a>

        </td>

    </tr>

</table>

<p style=" margin-top:30px; font-size:14px; color:#6b7280;">
    Se non hai richiesto questa operazione contatta il supporto.
</p>


@endsection