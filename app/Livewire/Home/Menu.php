<?php

namespace App\Livewire\Home;

use App\Models\Category;
use App\Models\Pizza;
use Livewire\Component;
use Livewire\WithPagination;

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
        $categories = Category::where('is_active', true)->get();

        $query = Pizza::where('is_active', true)
            ->with(['category', 'ingredients']);

        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }

        $pizzas = $query->latest()->paginate(8);

        return view('livewire.home.menu', [
            'categories' => $categories,
            'pizzas' => $pizzas
        ]);
    }
}
