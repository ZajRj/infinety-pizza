<?php

return [
    'title' => 'Pedido',
    'plural' => 'Pedidos',
    'fields' => [
        'id' => 'Pedido #',
        'customer' => 'Cliente',
        'status' => 'Estado',
        'total' => 'Monto Total',
        'created_at' => 'Fecha del Pedido',
        'items' => 'Artículos',
        'pizza' => 'Pizza',
        'quantity' => 'Cantidad',
        'unit_price' => 'Precio Unitario',
        'subtotal' => 'Subtotal',
    ],
    'sections' => [
        'summary' => 'Resumen del Pedido',
        'summary_description' => 'Información general sobre el pedido.',
        'items' => 'Artículos del Pedido',
        'items_description' => 'Añadir pizzas al pedido.',
        
    ],
    'steps' => [
        'details' => 'Detalles del Pedido',
        'items' => 'Selección',
        'summary' => 'Confirmación',
    ],
    'statuses' => [
        'pending' => 'Pendiente',
        'confirmed' => 'Confirmada',
        'cancelled' => 'Cancelada',
    ],
];
