<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de Mot de Passe - Mystory-Cosmetics</title>
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
            background-color: #000;
            color: #fff;
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
            <img src="{{ $infos->logo ? Storage::url($infos->logo) : ''}}" alt="Mystory-Cosmetics Logo">
            <h1>Réinitialisation de votre mot de passe</h1>
        </div>
        <div class="content">
            <p>Bonjour {{ $user->nom  }},</p>
            <p>Nous avons reçu une demande de réinitialisation de votre mot de passe. Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous :</p>
            <p><a href="{{ $url }}">Réinitialiser mon mot de passe</a></p>
            <p>Si vous n'avez pas demandé de réinitialisation de mot de passe, veuillez ignorer cet e-mail.</p>
            <p>Merci et à bientôt sur Mystory-Cosmetics.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Mystory-Cosmetics. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
