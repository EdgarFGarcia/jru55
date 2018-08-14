<?php

namespace App\Http\Controllers\Vote;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vote\Vote;
use DB;

class Voting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = Vote::select('vote.*', 'users.*', 'cand_position.*')
                ->where('is_open', '=', 1)
                ->where('running_for', '=', 1)
                ->where('approved', '=', 1)
                ->leftJoin('users', 'vote.student_id', '=', 'users.id')
                ->leftJoin('cand_position', 'vote.running_for', '=', 'cand_position.id')
                ->get();
        if($query){
            return view('vote.votes', compact('query'));
        }else{
            return redirect('vote/votes')->with('error', 'No Active Election this time');
        }
    }

    public function vice(){
        $query = Vote::select('*')
                ->where('is_open', '=', 1)
                ->where('running_for', '=', 2)
                ->where('approved', '=', 1)
                ->leftJoin('users', 'vote.student_id', '=', 'users.id')
                ->leftJoin('cand_position', 'vote.running_for', '=', 'cand_position.id')
                ->get();
        return view('vote.vicepresident', compact('query'));
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
        $id = $request->id;
        // return $test = DB::table('vote')->whereId($id)->increment('votes');
        $query = DB::table('vote')->where('student_id', '=', $id)->increment('votes', 1);
        if($query){
            return redirect('/home')->with('success', 'Thank you for your participation on election');
        }else{
            return redirect('/home')->with('error', 'There is an error on your voting');
        }
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
