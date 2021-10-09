<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\RoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoomRequest $request)
    {
        $request->header('Accept', 'application/json');

        // sort order
        $sortColumn = $request->get('sort_column', 'total_price');
        $sortOrder = $request->get('sort_order', 'asc');

        // filter
        $hotelId = $request->get('hotel_id', null);

        $rooms = Room::addSelect([
                "rooms.*",
                "hotels.name as hotel_name",
                "hotels.rating as hotel_rating",
            ])
            ->hotelsJoin($hotelId);

        // exclude SAME CODE rooms with in hotels but the ones which are with higher price
        if (! config('constants.include_duplicates_on_listing_rooms')) {
            $rooms = $rooms->minRateRooms();
        }

        $rooms = $rooms->orderBy("rooms.".$sortColumn, $sortOrder);

        return $rooms->paginate(config('constants.default_paginate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
