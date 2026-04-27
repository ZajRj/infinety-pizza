<?php

return [
    'title' => 'Order',
    'plural' => 'Orders',
    'fields' => [
        'id' => 'Order #',
        'customer' => 'Customer',
        'status' => 'Status',
        'total' => 'Total Amount',
        'created_at' => 'Order Date',
        'items' => 'Items',
        'pizza' => 'Pizza',
        'quantity' => 'Quantity',
        'unit_price' => 'Unit Price',
        'subtotal' => 'Subtotal',
    ],
    'sections' => [
        'summary' => 'Order Summary',
        'summary_description' => 'General information about the order.',
        'items' => 'Order Items',
        'items_description' => 'Add pizzas to the order.',
    ],
    'steps' => [
        'details' => 'Order Details',
        'items' => 'Selection',
        'summary' => 'Confirmation',
    ],
    'statuses' => [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],
];
