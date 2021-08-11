<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Reservation::class, 'reservation');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant = Auth::user()->restaurant;
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
        $request->validate([
            'start-day' => 'required|date_format:Y-m-d',
            'start-time' => 'required|date_format:H:i',
            'duration' => 'required|numeric|gte:0',
            'max-person-count' => 'required|numeric',
            'description' => 'string|nullable',
        ]);

        $restaurant = Auth::user()->restaurant;
        $startTime = new \DateTime($request->input('start-time'));
        $startDateTime = (new \DateTime($request->input('start-day')))
                       ->setTime(
                           $startTime->format('H'),
                           $startTime->format('i'),
                       );
        $endDateTime = (clone $startDateTime)->add(
            new \DateInterval("PT{$request->input('duration')}M")
        );

        Reservation::create([
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'max_person_count' => $request->input('max-person-count'),
            'description' => $request->input('description'),
            'restaurant_id' => $restaurant->id,
        ]);

        return redirect()->route('reservations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->fill($request->all())->save();
        return redirect()->route('reservations.show', compact('reservation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index');
    }
}
