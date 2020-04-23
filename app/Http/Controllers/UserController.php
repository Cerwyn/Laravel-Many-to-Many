<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['message'=>null,'data'=>$users],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateUser();
        if($validator->fails()){
            return response()->json($validator->messages(), 422);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        return response()->json(['message'=>'User Created','data'=>$user],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['message'=>null,'data'=>$user],200);
    }

    public function book_event(Request $request, User $user, Event $event)
    {
        $note = '';
        if($request->note){
            $note = $request->note;
        }
        if($user->events()->save($event, array('note' => $note))){
            return response()->json(['message'=>'User Event Created','data'=>$event],200);
        }
        return response()->json(['message'=>'Error','data'=>null],400);
    }

    public function validateUser(){
        return Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
}
