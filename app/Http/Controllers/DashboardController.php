<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function reservations() {
        $reservations = \Auth::user()->restaurant->reservations->sortByDesc('start_time');
        $groups = $reservations->groupBy(function ($item, $key) {
            return $item->start_time->format('Y-m-d');
        });

        return view('dashboard.reservations', compact('groups'));
    }
}
