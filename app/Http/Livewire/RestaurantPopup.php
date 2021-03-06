<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Restaurant;

class RestaurantPopup extends Component
{
    public $restaurants;
    public $currentRestaurant = null;
    public $showRoute = '';

    public function mount() {
        $this->restaurants = Restaurant::all()
                           ->only(['name', 'description', 'uuid']);
    }

    public function render()
    {
        return view('livewire.restaurant-popup');
    }

    public function setRestaurant(Restaurant $restaurant) {
        $this->currentRestaurant = $restaurant;
        $this->showRoute = route('restaurant.show', compact('restaurant'));
    }
}
