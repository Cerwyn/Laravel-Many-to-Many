<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $events = $user->events;
        return response()->json(['message'=>null,'data'=>$events],200);
    }

}
