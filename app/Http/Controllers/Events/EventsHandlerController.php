<?php

namespace App\Http\Controllers\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Event\Event;
// use App\Model\User\Profile;
use App\Model\Grade\Grade;
use Auth;

class EventsHandlerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = Event::select('*')->get();
        $user = Auth::User()->name;
        $grade = Grade::select('*')->get();
        return view('events.event', compact('query', 'user', 'grade'));
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
        // return $request->all();
        $this->validate($request, [
            'title' => 'required|string|regex:^(?!\d+$)\w+\S+^|unique:events',
            'body' => 'required|string|regex:^(?!\d+$)\w+\S+^',
            'category' => 'required|regex:^(?!\d+$)\w+\S+^'
        ]);

        // $date = $request->date;
        // $format = strtotime('Y-m-d H:i:s', $date);

        $query = new Event;
        $query->events_who = $request->grade;
        $query->whenevent = $request->date;
        $query->where = $request->where;
        $query->title = $request->title;
        $query->body = $request->body;
        $query->category = $request->category;
        $query->created_by = $request->created_by;
        $query->save();

        return redirect('/event')->with('success', 'Adding An Event Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // return $id;
        $query = Event::where('id', '=', $id)->first();
        if($query){
            $who = Event::select('events.*', 'grade.grade as grade', 'grade.id as gid')
                    ->leftJoin('grade', 'events.events_who', '=', 'grade.id')
                    ->first();
            $grades = Grade::select('*')->get();
            return view('events.eventedit', compact('query', 'who', 'grades'));
        }else{
            return redirect('/event')->with('error', 'Event Not Found!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // return $request->all();

        $this->validate($request, [
            'title' => 'required|string|unique:events,title,'.$id,
            'body' => 'required|string',
            'category' => 'required|string'
        ]);

        $checkbox = array(
            'is_active' => ((is_null($request->active)) ? "0":"1"),
            'approve' => ((is_null($request->approve)) ? "0":"1")
        );

        $query = Event::find($id);
        $query->title = $request->title;
        $query->body = $request->body;
        $query->category = $request->category;
        $query->events_who = $request->who;
        $query->whenevent = $request->when;
        $query->where = $request->where;
        $query->is_active = $checkbox['is_active'];
        $query->dateapproved = $checkbox['approve'];
        $query->save();

        return redirect('/event')->with('success', 'Editing Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
