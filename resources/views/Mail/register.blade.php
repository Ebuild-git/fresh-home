<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'Inscription - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .header {
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #000;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ $infos->logo ? Storage::url($infos->logo) : ''}}" alt="{{ url('/icons/logo.png') }}">
            <h1>{{ __('mail_1') }} {{ config('app.name') }}</h1>
        </div>
        <div class="content">
            <p>{{ __('bonjour') }} {{ $user->nom }},</p>
            <p>
                {{ __('mail_5') }} {{ config('app.name') }}. 
                {{ __('mail_6') }}
            </p>
            <p>
                {{ __('mail_7') }}
            </p>
            <p>{{ __('mail_8') }} {{ config('app.name') }}.</p>
        </div>
        <div class="footer">
            <p>
                &copy; 2024 {{ config('app.name') }}.
                {{ __('all_rights') }}.
            </p>
        </div>
    </div>
</body>
</html>
