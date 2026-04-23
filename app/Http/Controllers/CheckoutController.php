<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Mocking some items for the checkout view
        $items = Pizza::take(2)->get();
        
        return view('pages.checkout.index', compact('items'));
    }
}
