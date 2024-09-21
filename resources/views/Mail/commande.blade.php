<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Commande - Fresh Home</title>
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
            <img src="{{ url('/icons/icon-black.png') }}" alt="Fresh Home Logo">
            <h1>{{ __('commandes') }}</h1>
            <h4>
                {{ __('reference') }} : {{ $commande->id }}
            </h4>
        </div>
        <div class="content">
            <p>{{ __('bonjour') }} {{ $commande->prenom }},</p>
            <p>
                {{ __('mail_2') }}
            </p>
            <p>{{ __('mail_1') }} :</p>
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
            <p>{{ __('frais_livraison') }} : {{ $commande->frais }} <x-devise></x-devise> </p>
            <p>
                {{ __('timbre') }} : {{ $commande->timbre }} <x-devise></x-devise> 
            </p>
            <p>
                Total: {{ $total }} <x-devise></x-devise> 
            </p>
            <p>
                {{ __('adresse_livraison') }} :
            </p>
            <p>
                {{ $commande->adesse }}
            </p>
            <p>
                {{ __('merci') }}
            </p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Fresh Home. {{ __('all_rights') }}</p>
        </div>
    </div>
</body>

</html>
