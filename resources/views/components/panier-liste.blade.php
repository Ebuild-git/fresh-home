<ul class="minicart-product-list">
    @forelse ($produits as $produit)
        <li>
            <a href="{{ route('produit', ['id' => $produit['id'], 'slug' => $produit['slug']]) }}" class="image">
                <img src="{{ $produit['photo'] }}" alt="{{ $produit['nom'] }}">
            </a>
            <div class="content">
                <a href="{{ route('produit', ['id' => $produit['id'], 'slug' => $produit['slug'] ]) }}" class="title">
                    {{ $produit['nom'] }}
                </a>
                <span class="quantity-price">
                    {{ $produit['quantite'] }} x <span class="amount">{{ $produit['prix'] }} <x-devise></x-devise> </span> 
                </span>
                <a href="#" class="remove delete-item-to-cart" data-id="{{ $produit['id'] }}">×</a>
            </div>
        </li>
    @empty
        <li class="empty-cart">
            Aucun article disponible dans votre panier !
        </li>
    @endforelse
</ul>
