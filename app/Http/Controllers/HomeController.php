<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Event\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $queryEvents = Event::select('events.*', 'grade.id as gid', 'grade.grade as grade')
                            ->orderBy('id', 'desc')
                            ->leftJoin('grade', 'events.events_who', '=', 'grade.id')->get();

        return view('home', compact('queryEvents'));
    }
}
