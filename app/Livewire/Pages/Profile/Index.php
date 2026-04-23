<?php

namespace App\Livewire\Pages\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $user;
    public $totalSpend;

    // Order View State
    public bool $showAllOrders = false;

    // Edit Mode State
    public bool $isEditing = false;
    public $name;
    public $email;
    public $phone_number;
    public $dni;
    public $address;

    public function paginationView()
    {
        return 'vendor.pagination.custom';
    }

    public function mount()
    {
        $this->refreshUserData();
    }

    public function refreshUserData()
    {
        $this->user = Auth::user();
        
        // Force refresh to get latest DB values (e.g. after update)
        if ($this->user) {
            $this->user->refresh();
        }
        
        // Calculating total spend based on order totals
        $this->totalSpend = $this->user->orders()->sum('total');

        // Initialize form fields
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone_number = $this->user->phone_number;
        $this->dni = $this->user->dni;
        $this->address = $this->user->address;
    }

    public function toggleEdit()
    {
        $this->isEditing = !$this->isEditing;
        
        if (!$this->isEditing) {
            $this->refreshUserData();
        }
    }

    public function toggleAllOrders()
    {
        $this->showAllOrders = !$this->showAllOrders;
        $this->resetPage();
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'dni' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($this->user->id)],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        $this->user->update($validated);
        
        $this->isEditing = false;
        $this->refreshUserData();

        session()->flash('success', 'Profile updated successfully!');
        $this->dispatch('notify', message: 'Profile updated successfully!', type: 'success');
    }

    public function render()
    {
        $ordersQuery = $this->user->orders()->latest();

        $orders = $this->showAllOrders 
            ? $ordersQuery->paginate(10) 
            : $ordersQuery->take(5)->get();

        return view('livewire.pages.profile.index', [
            'orders' => $orders
        ]);
    }
}
