<ul class="minicart-product-list">
    @forelse ($favoris as $item)
        @if ($item->produit)
            <li>
                <a href="{{ route('produit', ['id' => $item->produit->id, 'slug' => Str::slug($item->produit->nom)]) }}" class="image">
                    <img src="{{ Storage::url($item->produit->photo) }}" alt="{{ $item->produit->nom }}">
                </a>
                <div class="content">
                    <a href="{{ route('produit', ['id' => $item->produit->id, 'slug' => Str::slug($item->produit->nom)]) }}" class="title">
                        {{ Str::limit($item->produit->nom , 30) }}
                    </a>
                    <span class="quantity-price">
                        <span class="amount">
                            {{ $item->produit->getPrice() }}
                            <x-devise></x-devise>
                        </span>
                    </span>
                    <a href="javascript:void();" class="remove delete-from-wish" data-id="{{ $item->produit->id }}" >×</a>
                </div>
            </li>
        @endif
    @empty
        <li class="empty-cart text-center p-3">
            vous n'avez pas de produit en favoris !
        </li>
    @endforelse
</ul>
