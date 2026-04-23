<?php

namespace App\Livewire\Pages\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Index extends Component
{
    public $user;
    public $orders;
    public $totalSpend;

    public function mount()
    {
        $this->user = Auth::user();
        
        // Fetching real orders from the database
        $this->orders = $this->user->orders()
            ->latest()
            ->take(10)
            ->get();

        // Calculating total spend based on order totals
        $this->totalSpend = $this->user->orders()->sum('total');
    }

    public function render()
    {
        return view('livewire.pages.profile.index');
    }
}
