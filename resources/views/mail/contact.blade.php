<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    <style>
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

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="header">
                            <a href="{{ $header_url }}">
                                {{ $header_text }}
                            </a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        <h1>Hello</h1>
                                        <p>You have received query from {{ $name }}.</p>
                                        <p>{{ $email }}.</p>
                                        <p>{{ $phone }}.</p>
                                        <p>{{ $message }}</p>

                                        <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td>
                                                    {{-- <a href="{{$url}}" class="btn btn-primary">Accept</a> --}}
                                                </td>
                                            </tr>
                                        </table>
                                        <p>Regards,<br>{{ config('app.name', 'Laravel') }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- <tr>
                        <td>
                            <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td class="content-cell" align="center">
                                        <p>If you're having trouble clicking the "Accept" button, copy and paste the URL below
                                            into your web browser: </p>
                                        <span>
                                            <a href="{{$url}}">{{$url}}</a>
                                        </span>
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
