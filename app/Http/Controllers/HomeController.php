<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->get();
        
        // Fetch all active pizzas for the main menu
        $pizzas = Pizza::where('is_active', true)
            ->with(['category', 'ingredients'])
            ->get();

        // Fetch 3 random "Featured" pizzas for the hero highlight section
        $featuredPizzas = Pizza::where('is_active', true)
            ->with(['category', 'ingredients'])
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.home.index', compact('categories', 'pizzas', 'featuredPizzas'));
    }

     public function show(Pizza $pizza)
    {
        $pizza->load(['category', 'ingredients']);

        $relatedPizzas = Pizza::where('category_id', $pizza->category_id)
            ->where('id', '!=', $pizza->id)
            ->where('is_active', true)
            ->with(['category', 'ingredients'])
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.products.show', compact('pizza', 'relatedPizzas'));
    }
}
