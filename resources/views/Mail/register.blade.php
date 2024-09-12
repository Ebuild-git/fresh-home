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
            <img src="{{ url('/icons/icon-black.png') }}" alt="{{ url('/icons/logo.png') }}">
            <h1>Bienvenue chez {{ config('app.name') }}</h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $user->nom }},</p>
            <p>Merci de vous être inscrit sur {{ config('app.name') }}. Nous sommes ravis de vous compter parmi nos clients.</p>
            <p>Vus pouvez des a présent faire des achats</p>
            <p>Merci et à bientôt sur {{ config('app.name') }}.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 {{ config('app.name') }}. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
