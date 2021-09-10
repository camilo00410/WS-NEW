<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Auth::user()->events()->get();

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only([
            'slug', 'name', 'date'
        ]);

        $val = Validator::make($input, [
            'slug' => 'required',
            'name' => 'required',
            'date' => 'required'
        ]);

        if($val->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'The fields required'
            ]);
        }

        $slug = Validator::make($input, [
            'slug' => 'required'
        ]);

        preg_match('/[^a-z0-9\-]/', $input['slug'], $match);

        if($slug->fails() || count($match) > 0){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'add a-z, 0-9 and -'
            ]);
        }

        $date = Validator::make($input, [
            'date' => 'date'
        ]);

        if($date->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'the field date is incorrect'
            ]);
        }

        $slugR = Auth::user()->events()->where('slug', $input['slug'])->first();
        if($slugR){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'the slug is exist'
            ]);
        }

        $event = Auth::user()->events()->save(new Event($input));

        return redirect()->route('event.show', $event)->with([
            'message_type' => 'success',
            'message' => 'event successfull created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.detail', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $input = $request->only([
            'slug', 'name', 'date'
        ]);

        $val = Validator::make($input, [
            'slug' => 'required',
            'name' => 'required',
            'date' => 'required'
        ]);

        if($val->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'The fields required'
            ]);
        }

        $slug = Validator::make($input, [
            'slug' => 'required'
        ]);

        preg_match('/[^a-z0-9\-]/', $input['slug'], $match);

        if($slug->fails() || count($match) > 0){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'add a-z, 0-9 and -'
            ]);
        }

        $date = Validator::make($input, [
            'date' => 'date'
        ]);

        if($date->fails()){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'the field date is incorrect'
            ]);
        }

        $slugR = Auth::user()->events()->where('slug', $input['slug'])->first();
        if($slugR){
            return back()->with([
                'message_type' => 'danger',
                'message' => 'the slug is exist'
            ]);
        }

        $event->update($input);

        return redirect()->route('event.show', $event)->with([
            'message_type' => 'success',
            'message' => 'event successfull created'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
