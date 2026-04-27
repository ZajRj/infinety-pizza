<?php

namespace App\Livewire\Home;

use App\Models\Category;
use App\Models\Pizza;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;

class Menu extends Component
{
    use WithPagination;

    public $categoryId = null;

    protected $queryString = ['categoryId'];

    public function paginationView()
    {
        return 'vendor.pagination.custom';
    }

    public function setCategory($id = null)
    {
        $this->categoryId = $id;
        $this->resetPage();
    }

    public function render()
    {
        // Get current menu cache version (invalidated when pizzas/categories/ingredients change)
        $menuVersion = Cache::rememberForever('menu_cache_version', fn() => time());

        // Cache categories for 1 hour
        $categories = Cache::remember("menu_categories_v{$menuVersion}", 3600, function () {
            return Category::all();
        });

        // Cache pizzas based on category and page for 1 hour
        $cacheKey = "menu_pizzas_cat_{$this->categoryId}_page_" . $this->getPage() . "_v{$menuVersion}";
        
        $pizzas = Cache::remember($cacheKey, 3600, function () {
            $query = Pizza::query()->with('category');

            if ($this->categoryId) {
                $query->where('category_id', $this->categoryId);
            }

            return $query->latest()->paginate(6);
        });

        return view('livewire.home.menu', [
            'categories' => $categories,
            'pizzas' => $pizzas
        ]);
    }
}
