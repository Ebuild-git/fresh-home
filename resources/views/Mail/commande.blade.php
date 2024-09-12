<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Commande - Mystory-Cosmetics</title>
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
            <img src="{{ url('/icons/icon-black.png') }}" alt="Mystory-Cosmetics Logo">
            <h1>Merci pour votre commande</h1>
            <h4>
                Référence : {{ $commande->id }}
            </h4>
        </div>
        <div class="content">
            <p>Bonjour {{ $commande->prenom }},</p>
            <p>Merci pour votre commande chez Mystory-Cosmetics. Nous préparons votre commande avec soin et vous
                tiendrons informé dès qu'elle sera expédiée.</p>
            <p>Détails de la commande :</p>
            <ul>
                @php
                    $total = $commande->frais + $commande->timbre;
                @endphp
                @foreach ($commande->contenus as $item)
                    <li>
                        {{ $item->produit->nom }} ( x {{ $item->quantite }} ) :
                        {{ $item->prix_unitaire * $item->quantite }}
                        <x-devise></x-devise>
                    </li>
                    @php
                        $total += $item->prix_unitaire * $item->quantite;
                    @endphp
                @endforeach
            </ul>
            <p>Frais de livraison : {{ $commande->frais }} <x-devise></x-devise> </p>
            <p>Timbre : {{ $commande->timbre }} <x-devise></x-devise> </p>
            <p>Total: {{ $total }} <x-devise></x-devise> </p>
            <p>Adresse de livraison :</p>
            <p>{{ $commande->adesse }}</p>
            <p>Merci et à bientôt sur Mystory-Cosmetics.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Mystory-Cosmetics. Tous droits réservés.</p>
        </div>
    </div>
</body>

</html>
