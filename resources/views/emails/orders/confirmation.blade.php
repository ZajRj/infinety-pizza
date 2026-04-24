<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; border-bottom: 2px solid #D32F2F; padding-bottom: 20px; margin-bottom: 20px; }
        .logo { color: #D32F2F; font-size: 24px; font-weight: bold; text-transform: uppercase; letter-spacing: 2px; }
        .order-meta { background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .item { border-bottom: 1px solid #eee; padding: 15px 0; }
        .item:last-child { border-bottom: none; }
        .item-name { font-weight: bold; font-size: 18px; color: #D32F2F; }
        .ingredients { font-size: 12px; color: #777; margin-top: 5px; font-style: italic; }
        .observations { font-size: 13px; color: #555; background: #fff8f8; padding: 5px 10px; border-radius: 4px; margin-top: 10px; border-left: 3px solid #D32F2F; }
        .total { font-size: 20px; font-weight: bold; text-align: right; margin-top: 20px; color: #D32F2F; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #aaa; border-top: 1px solid #eee; pt-20; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Infinety Pizza</div>
            <h1>{{ __('Order Confirmation') }}</h1>
        </div>

        <p>{{ __('Hi') }} {{ $order->user->name }},</p>
        <p>{{ __('Thank you for your order! We are currently preparing your artisanal pizza with passion.') }}</p>

        <div class="order-meta">
            <strong>{{ __('Order') }} #:</strong> {{ $order->id }}<br>
            <strong>{{ __('Date') }}:</strong> {{ $order->created_at->format('M d, Y H:i') }}<br>
            <strong>{{ __('Address') }}:</strong> {{ $order->delivery_address }}
        </div>

        <h3>{{ __('Order Details') }}</h3>
        @foreach($order->orderDetails as $detail)
            <div class="item">
                <div class="item-name">{{ $detail->quantity }}x {{ $detail->pizza_name }}</div>
                @if($detail->pizza && $detail->pizza->ingredients->count() > 0)
                    <div class="ingredients">
                        {{ __('Ingredients') }}: {{ $detail->pizza->ingredients->pluck('name')->implode(', ') }}
                    </div>
                @endif
                @if($detail->observations)
                    <div class="observations italic">
                        "{{ $detail->observations }}"
                    </div>
                @endif
                <div style="text-align: right; font-weight: bold;">
                    {{ number_format($detail->price * $detail->quantity, 2) }}€
                </div>
            </div>
        @endforeach

        <div class="total">
            {{ __('Total') }}: {{ number_format($order->total, 2) }}€
        </div>

        <div class="footer">
            <p>{{ __('Thank you for choosing Infinety Pizza - The Art of Dough.') }}</p>
            <p>&copy; {{ date('Y') }} Infinety Pizza Co. Madrid, ES.</p>
        </div>
    </div>
</body>
</html>
