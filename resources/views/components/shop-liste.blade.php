@forelse ($produits as $produit)
    <div class="grid-item col sales">
        <div class="product">
            <div class="product-thumb">
                <a href="{{ route('produit', ['id' => $produit->id, 'slug' => Str::slug($produit->nom)]) }}"
                    class="image">
                    @if ($produit->id_promotion)
                        <span class="product-badges">
                            <span class="onsale">
                                {{ $produit->inPromotion->pourcentage }} %
                            </span>
                        </span>
                    @endif
                    <img src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}">
                    <img class="image-hover " src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}">
                </a>
                @auth
                    <a href="javascript:void();" class="add-to-wishlist hintT-left add-to-wish" data-id="{{ $produit->id }}" data-hint="Ajouter aux favoris">
                        <i class="far fa-heart"></i>
                    </a>
                @endauth
            </div>
            <div class="product-info">
                <h6 class="title">
                    <a href="{{ route('produit', ['id' => $produit->id, 'slug' => Str::slug($produit->nom)]) }}">
                        {{ Str::limit($produit->nom, 30) }}
                    </a>
                </h6>
                <span class="price">
                    @if ($produit->id_promotion)
                        <span class="old">
                            {{ $produit->prix }}
                            <x-devise></x-devise>
                        </span>
                    @endif

                    <span class="new">
                        {{ $produit->getPrice() }}
                        <x-devise></x-devise>
                    </span>
                </span>
                <div class="product-buttons">
                    <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top modal-view-open" data-id="{{ $produit->id }}"
                        data-hint="Regard rapide">
                        <i class="fas fa-search"></i>
                    </a>
                    <a href="javascript:void();" class="product-button hintT-top add-to-cart" data-id="{{ $produit->id }}" data-hint="Ajouter au panier">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

@empty
@endforelse
