<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return response()->json(['message'=>null,'data'=>$events],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateEvent();
        if($validator->fails()){
            return response()->json($validator->messages(), 422);
        }

        $event = Event::create($validator->validate());
        return response()->json(['message'=>'Event Created','data'=>$event],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response()->json(['message'=>null,'data'=>$event],200);
    }


    public function validateEvent(){
        return Validator::make(request()->all(), [
            'event_name' => 'required|string|max:25',
            'event_detail' => 'required|string|max:255',
        ]);
    }
}
