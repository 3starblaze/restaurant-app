<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CalendarReservation extends Component
{
    public $restaurant;
    public $date;
    public $reservations = [];

    protected $listeners = ['selected' => 'setDate'];

    public function mount($restaurant)
    {
        $this->setDate(today());
    }

    public function render()
    {
        return view('livewire.calendar-reservation');
    }

    public function setDate($date) {
        $this->date = new \Datetime($date);
        $this->reservations = $this->restaurant->reservations->filter(
            function ($value, $key) {
                return $value->start_time->format('Y-m-d')
                    === $this->date->format('Y-m-d');
            });
    }
}
