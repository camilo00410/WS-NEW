<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('sessions.create', compact('event'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $input = $request->only([
            'start', 'end', 'description', 'type', 'title', 'speaker', 'cost', 'room_id'
        ]);

        $val = Validator::make($input, [
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'type' => 'required',
            'title' => 'required',
            'speaker' => 'required',
            'cost' => 'required',
            'room_id' => 'required',
        ]);

        if($val->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'las filas son requeridas'
            ]);
        }

        $room = Room::find($input['room_id']);
        $roomE = false;

        $date1 = date_format(new DateTime($input['start']), 'H:i');
        $date2 = date_format(new DateTime($input['end']), 'H:i');

        foreach($room->sessions as $session){
            $date3 = date_format(new \Datetime($session['start'], 'H:i'));
            $date4 = date_format(new DateTime($session['end'], 'H:i'));

            if(($date3 >= $date1 && $date3 <= $date2 ) || ($date4 >= $date1 && $date4 >= $date2)){
                $roomE = true
            }

        }

        if($roomE){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'fecha ocupada para esta sala'
            ]);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
