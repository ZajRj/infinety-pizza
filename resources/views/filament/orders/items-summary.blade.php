@php
    use App\Models\Pizza;
    use Illuminate\Support\Facades\Storage;
@endphp

<style>
    .pizza-summary-container {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1rem;
    }
    .pizza-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background-color: rgba(var(--gray-50), 0.5);
        border: 1px solid rgba(var(--gray-200), 0.5);
        border-radius: 1.25rem;
    }
    .pizza-image-wrapper {
        position: relative;
        flex-shrink: 0;
        width: 4.5rem;
        height: 4.5rem;
        overflow: hidden;
        border-radius: 0.75rem;
        border: 2px solid white;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    .pizza-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .pizza-info {
        flex: 1;
        min-width: 0;
    }
    .pizza-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 0.5rem;
    }
    .pizza-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: rgb(var(--gray-950));
        margin: 0;
    }
    .pizza-price-group {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    .pizza-quantity {
        font-size: 0.75rem;
        font-weight: 600;
        color: rgb(var(--gray-500));
    }
    .pizza-price {
        font-size: 1.1rem;
        font-weight: 900;
        color: rgb(var(--primary-600));
    }
    .pizza-desc {
        font-size: 0.75rem;
        color: rgb(var(--gray-500));
        margin: 0.125rem 0 0.5rem 0;
    }
    .ingredient-tag {
        display: inline-block;
        padding: 0.125rem 0.5rem;
        font-size: 10px;
        font-weight: 600;
        background-color: rgba(var(--primary-500), 0.1);
        color: rgb(var(--primary-700));
        border-radius: 9999px;
        border: 1px solid rgba(var(--primary-500), 0.1);
    }
    .observation-note {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 10px;
        font-weight: 500;
        color: rgb(var(--danger-600));
        font-style: italic;
    }
</style>

<div class="pizza-summary-container">
    @forelse($items as $item)
        @php
            $pizza = Pizza::find($item['pizza_id'] ?? null);
            $qty = intval($item['quantity'] ?? 1);
            $price = floatval($item['price'] ?? 0);
            $subtotal = $qty * $price;
        @endphp
        @if($pizza)
            <div class="pizza-card">
                <div class="pizza-image-wrapper">
                    @php
                        $imagePath = $pizza->first_image;
                        $imageUrl = $imagePath ? Storage::url($imagePath) : 'https://placehold.co/200x200?text=' . urlencode($pizza->name);
                    @endphp
                    <img src="{{ $imageUrl }}" 
                         alt="{{ $pizza->name }}" 
                         class="pizza-image"
                         onerror="this.src='https://placehold.co/200x200?text=Pizza'" />
                </div>
                
                <div class="pizza-info">
                    <div class="pizza-header">
                        <h4 class="pizza-name truncate">{{ $pizza->name }}</h4>
                        <div class="pizza-price-group">
                            @if($qty > 1)
                                <span class="pizza-quantity">{{ $qty }} x ${{ number_format($price, 2) }}</span>
                            @endif
                            <span class="pizza-price">$ {{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>
                    
                    <p class="pizza-desc truncate">{{ $pizza->description }}</p>
                    
                    <div class="flex flex-wrap items-center gap-2">
                        @if($pizza->ingredients->isNotEmpty())
                            <div class="flex flex-wrap gap-1">
                                @foreach($pizza->ingredients->take(4) as $ingredient)
                                    <span class="ingredient-tag">{{ $ingredient->name }}</span>
                                @endforeach
                            </div>
                        @endif
                        
                        @if(!empty($item['observations']))
                            <span class="observation-note">
                                <svg style="width: 0.75rem; height: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $item['observations'] }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="p-8 text-center border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl">
            <p class="text-sm text-gray-400 dark:text-gray-500">No items selected yet.</p>
        </div>
    @endforelse
</div>
