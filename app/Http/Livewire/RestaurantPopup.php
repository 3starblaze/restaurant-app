<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Restaurant;

class RestaurantPopup extends Component
{
    public $restaurants;
    public $currentRestaurant = null;

    public function mount() {
        $this->restaurants = Restaurant::all();
    }

    public function render()
    {
        return view('livewire.restaurant-popup');
    }

    public function setRestaurant(Restaurant $restaurant) {
        $this->currentRestaurant = $restaurant;
    }
}
