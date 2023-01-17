@extends('master_email')
@section('content')
    <p class="Dear">{{ __('Dear') }}
        {{ $user->full_name }}
    </p>
    <br>
    <p class="greeting">{{ __('Welcome to ' . env('APP_NAME')) }}</p>
    <br>
    <p>{{ __('Your ' . env('APP_NAME') . ' Change Your Password') }}</p>
    <br>
    {{-- <p>{{ __('email.Date & Time:') }} {{ $date }}</p> --}}
    <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
        <tbody>
            <tr>
                <td colspan="2"></td>
                <td align="center" bgcolor="#000000" style="border-radius:30px; margin:10px; width: 50%;">
                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable"
                        style="font-size:18px; color:#ffffff; text-decoration:none; color:#ffffff; text-decoration:none; padding:10px 55px!important; border-radius:2px; display:inline-block;"
                        data-linkindex="0">{{ __('Change Your Password') }}</a>
                </td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

    <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
        <tbody>
            <tr>
                <td class="space-control" valign="middle" align="center" height="50">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <p>{{ __('Thank you!') }} </p>
@endsection
