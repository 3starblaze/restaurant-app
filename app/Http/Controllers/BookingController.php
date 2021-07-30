<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use App\Providers\RouteServiceProvider;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {
        $reservations = Reservation::whereDoesntHave('booking',
            function (Builder $q) use ($restaurant) {
                $q->where('restaurant_id', $restaurant->id);
            })->get();

        return view('bookings.index', [
            'reservations' => $reservations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone-number' => 'required|string',
            'notes' => 'string|nullable',
            'reservation-id' => 'required'
        ]);

        Booking::create([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone-number'),
            'notes' => $request->input('notes'),
            'reservation_id' => $request->input('reservation-id')
        ]);

        return redirect()->route('restaurant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $booking->fill($request->all())->save();
        return redirect()->route('bookings.show', compact('booking'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index');
    }
}
