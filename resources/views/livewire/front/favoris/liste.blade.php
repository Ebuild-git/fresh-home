<div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 list-view">
    @forelse ($favoris as $favori)
        <div class="col mb-3 px-2 px-md-3">
            <div class="card h-100 border-0 rounded-0 pro-card">
                <div class="overflow-hidden position-relative">
                    <a href="{{ route('produit', ['id' => $favori->produit->id, 'slug' => Str::slug($favori->produit->nom)]) }}">
                        <img src="{{ $favori->produit->FirstImage() }}" class="card-img-top  img-1" alt="...">
                        <img src="{{ $favori->produit->FirstImage() }}" class="w-100 img-2" alt>
                    </a>
                    <!-- NEW label -->
                    @if ($favori->produit->inPromotion())
                        <span class="arrow-label-wrap">
                            <span class="arrow-label bg-theme-sun">
                                -{{ $favori->produit->inPromotion()->pourcentage }}%
                            </span>
                        </span>
                    @endif
                    <!-- NEW label -->
                    <!-- options -->
                    <ul class="option-wrap">
                        <li tooltip="View" class="rounded-circle fav-list-icon" >
                            <a class="circle-round wishlist-btn text-danger" wire:click="delete({{ $favori->id }})">
                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li tooltip="Add To Cart" class="rounded-circle fav-list-icon">
                            <a class="option-btn circle-round addtocart-btn wishlist-btn"
                                onclick="calladdtocart({{ $favori->produit->id }})">
                                <i class="fa-sharp fa-regular fa-cart-plus"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- options -->
                </div>

                <!-- product content -->
                <div class="card-body px-0 pb-0">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <p class="card-title fs-7 text-muted m-0 text-truncate">
                            @if ($favori->produit->categorie)
                                {{ $favori->produit->categorie->nom }}
                            @else
                                <i class="text-muted">
                                    Aucune catégorie
                                </i>
                            @endif
                        </p>

                    </div>

                    <h5 class="product-name line-2">
                        <a href="{{ route('produit', ['id' => $favori->produit->id, 'slug' => Str::slug($favori->produit->nom)]) }}"
                            class="card-text text-dark mb-0 line-2" title="{{ $favori->produit->nom }}l">
                            {{ $favori->produit->nom }}
                        </a>
                    </h5>
                </div>

                <div class="card-footer px-0">
                    <h5 class="text-dark fw-semibold mb-0 product-price text-truncate">
                        @if ($favori->produit->inPromotion())
                            {{ $favori->produit->getPrice() }} DT
                            <del class="text-danger fw-500 fs-8 fw-normal">
                                {{ $favori->produit->prix }} DT
                            </del>
                        @else
                            {{ $favori->produit->prix }} DT
                        @endif
                    </h5>
                </div>
                <!-- product content -->
            </div>

        </div>
    @empty
        <div class="text-center p-3 col-12">
            <h5 class="text-muted">Aucun produit en favoris</h5>
        </div>
    @endforelse


</div>
