<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
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
        return view('tickets.create', compact('event'));        
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
            'name', 'cost', 'capacity', 'special_validity', 'amount', 'valid_until'
        ]);

        $args = [
            'name' => 'required',
            'cost' => 'required'
        ];

        $ticketArgs = [
            'name' => $input['name'],
            'cost' => $input['cost']
        ];

        if($input['special_validity'] == 'amount'){
            $args['amount'] = 'required';
            $ticketArgs['special_validity'] = json_encode(['type' => 'amount', 'amount' => $input['amount']]);
        }

        if($input['special_validity'] == 'date'){
            $args['valid_until'] = 'required';
            $ticketArgs['special_validity'] = json_encode(['type' => 'date', 'date' => $input['valid_until']]);
        }

        $val = Validator::make($input, $args);

        if($val->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'the fields required'
            ]);
        }

        $valDate = Validator::make($input, [
            'valid_until' => 'date|date_format:Y-m-d H:i'
        ]);

        if($valDate->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'Date format is wrong'
            ]);
        }

        $event->tickets()->save(new Ticket($ticketArgs));

        return redirect()->route('event.show', compact('event'))->with([
            'message_type' => 'success',
            'message' => 'the event successfull created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
