@if (count($produits) > 0)
    <div class="row row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
        @foreach ($produits as $produit)
            <div class="grid-item col sales">
                <div class="product-card-shop">
                    <div class="product-thumb">
                        <a href="{{ route('produit', ['id' => $produit->id, 'slug' => Str::slug($produit->nom)]) }}"
                            class="image">
                            @if ($produit->inPromotion())
                                <span class="product-badges">
                                    <span class="onsale">
                                        {{ $produit->inPromotion->pourcentage }} %
                                    </span>
                                </span>
                            @endif
                            <img src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}">
                            <img class="image-hover " src="{{ Storage::url($produit->photo) }}"
                                alt="{{ $produit->nom }}">
                        </a>
                    </div>
                    <div class="text-center small mt-2">
                        {{ $produit->categorie->nom }}
                    </div>
                    <div class="text-center mt-2">
                        <h6 class="title">
                            <a href="{{ route('produit', ['id' => $produit->id, 'slug' => Str::slug($produit->nom)]) }}"
                                class="mada-font">
                                {{ \App\Helpers\TranslationHelper::TranslateText(Str::limit($produit->nom, 30)) }}
                            </a>
                        </h6>
                    </div>
                    <div class="text-center mt-2">
                        <span class="price small">
                            <b>
                                @if ($produit->inPromotion())
                                    <span class="old">
                                        {{ $produit->prix }}
                                        <x-devise></x-devise>
                                    </span>
                                @endif

                                <span class="new">
                                    {{ $produit->getPrice() }}
                                    <x-devise></x-devise>
                                </span>
                            </b>
                        </span>
                    </div>
                    <div class="text-center mt-2">
                        <a href="javascript:void();" class="btn-add"
                            data-id="{{ $produit->id }}" data-hint="{{ __('add_cart') }}">
                            {{ __('add_cart') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="grid-item col-12 sales">
        <div class="text-center p-3">
            <h4>Aucun produit disponible</h4>
            <a href="{{ route('shop') }}">Voir tous les produits</a>
        </div>
    </div>
@endif
