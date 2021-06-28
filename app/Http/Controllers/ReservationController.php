<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reservations.index', [
            'reservations' => Reservation::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
        return view('reservations.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reservation = new Reservation();
        $reservation->fill($request->all());

        $id = $request->restaurant_id;
        $restaurant = Restaurant::find($id);
        //$restaurant = $reservation->restaurant;

        // input current user name automatically (can also choose to use different person name)
        // TODO: get real user data here (auth)
        if ($reservation->reserver === null) {
            $reservation->reserver = User::all()->first()->name;
        }

        $restaurant->reservations()->save($reservation);

        return redirect()->route('reservations.index')
            ->with('success','Reservation successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $restaurant = Restaurant::find($reservation->restaurant_id);
        return view('reservations.show', compact('reservation', 'restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update($request->all());

        return redirect()->route('reservations.index')
            ->with('success','Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        // TODO: fix the deletion. Possible implementation of soft deletion
        $restaurant = $reservation->restaurant;
        $restaurant->reservations()
            ->where('id', $reservation->id)->delete();

        return redirect()->route('reservations.index')
            ->with('success','Reservation canceled successfully.');
    }
}
