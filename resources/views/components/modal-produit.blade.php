<!-- Product Images Start -->
<div class="col-lg-4 col-12 ">
    <div class="product-images">
        <div class="product-gallery-slider-quickview">
            <div class="product-zoom" data-image="{{ Storage::url($produit->photo) }}">
                <img src="{{ Storage::url($produit->photo) }}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Product Images End -->

<!-- Product Summery Start -->
<div class="col-lg-7 col-12 overflow-hidden position-relative ">
    <div class="product-summery customScroll">
        <h3 class="product-title">
            {{ $produit->nom }}
        </h3>
        <div class="product-price">
            {{ $produit->getPrice() }}
            <x-devise></x-devise>
        </div>
        <div class="product-description">
            <p>
                {{ $produit->description }}
            </p>
        </div>
        <div class="product-variations">
            <table>
                <tbody>
                    <tr>
                        <td class="label"><span>Quantité</span></td>
                        <td class="value">
                            <div class="product-quantity">
                                <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                <input type="text" class="input-qty" value="1">
                                <span class="qty-btn plus"><i class="ti-plus"></i></span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="product-buttons">
            <a href="#" class="btn btn-icon btn-outline-body btn-hover-dark"><i class="far fa-heart"></i></a>
            <a href="#" class="btn btn-dark btn-outline-hover-dark"><i class="fas fa-shopping-cart"></i>
                Ajouter au panier
            </a>
        </div>
        <div class="product-meta mb-0">
            <table>
                <tbody>
                    <tr>
                        <td class="label"><span>REFERENCE </span></td>
                        <td class="value">{{ $produit->reference }}</td>
                    </tr>
                    <tr>
                        <td class="label"><span>Categorie</span></td>
                        <td class="value">
                            <ul class="product-category">
                                <li><a href="#">{{ $produit->categorie->nom  }}</a></li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Product Summery End -->