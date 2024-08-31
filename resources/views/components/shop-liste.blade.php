@forelse ($produits as $produit)
    <div class="grid-item col sales">
        <div class="product">
            <div class="product-thumb">
                <a href="{{ route('produit', ['id' => $produit->id, 'slug' => Str::slug($produit->nom)]) }}" class="image">
                    <span class="product-badges">
                        <span class="onsale">-13%</span>
                    </span>
                    <img src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}">
                    <img class="image-hover " src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}">
                </a>
                @auth
                    <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist">
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
                    <span class="old">$45.00</span>
                    <span class="new">$39.00</span>
                </span>
                <div class="product-buttons">
                    <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top"
                        data-hint="Quick View">
                        <i class="fas fa-search"></i>
                    </a>
                    <a href="#" class="product-button hintT-top" data-hint="Add to Cart">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

@empty
@endforelse
