<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\Profile;
use App\Model\Grade\Grade;
use App\Model\Section\Section;
use App\Model\Club\Club;
use App\Model\Position\Position;
use App\Model\Vote\Vote;
use App\Model\CandPosition\Position as poscand;
use Auth;
use Carbon\Carbon;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userId = Auth::User()->id;

        $query = Profile::where('id', '=', $userId)->first();

        $getAllUsers = Profile::select('*')
                    ->leftJoin('grade', 'grade.id', '=', 'users.grade')
                    ->leftJoin('section', 'section.id', '=', 'users.section')
                    ->leftJoin('clubs', 'clubs.id', '=', 'users.clubs')
                    ->leftJoin('user_position', 'user_position.id', '=', 'users.position')
                    ->orderBy('users.id', 'desc')
                    ->get();

        $grade = Grade::select('*')->get();

        $section = Section::select('*')->get();

        $clubs = Club::select('*')->get();

        $cand_position = poscand::select('*')->get();

        $who = Profile::where('position', '=', '4')
                        ->orWhere('position', '=', '1')
                        ->orWhere('position', '=', '2')->get();

        $positions = Position::select('*')->get();

        $userLevel = Profile::select('*')
                        ->leftJoin('user_position', 'users.position', '=', 'user_position.id')
                        ->first();

        return view('profile.profile', compact('query', 'getAllUsers', 'grade', 'section', 'clubs', 'who', 'positions', 'userLevel', 'cand_position'));
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
        $query = Profile::find($id);
        if($query){
            $grade = Grade::select('*')->get();

            $section = Section::select('*')->get();

            $clubs = Club::select('*')->get();

            $who = Profile::where('position', '=', '4')
                            ->orWhere('position', '=', '1')
                            ->orWhere('position', '=', '2')->get();

            $cand_position = poscand::select('*')->get();

            $running_for = Vote::select('users.id', 'cand_position.name as running', 'vote.approved')
                            ->leftJoin('users', 'vote.student_id', '=', 'users.id')
                            ->leftJoin('cand_position', 'vote.running_for', '=', 'cand_position.id')->first();

            $positions = Position::select('*')->get();

            if(!$running_for){
                return redirect('/profile')->with('error', 'Student is not running on any position');
            }

            return view('profile.profileedit', compact('query', 'grade', 'section', 'clubs', 'who', 'positions', 'cand_position', 'running_for'));
        }else{
            return redirect('/profile')->with('error', 'ID Does not exist');
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
        // $bday = $request->birthday;
        // $today = Carbon::now(-30);
        // $today2 = Carbon::now(-1);
        // $today3 = Carbon::now();

        // return $request->all();

        $this->validate($request, [
            'username' => 'required|string|regex:^(?!\d+$)\w+\S+^',
            'firstname' => 'required|string|regex:^(?!\d+$)\w+\S+^',
            'middlename' => 'required|string|regex:^(?!\d+$)\w+\S+^',
            'lastname' => 'required|string|regex:^(?!\d+$)\w+\S+^',
            'password' => 'sometimes|confirmed',
            'password_confirmation'=>'sometimes|required_with:password',
            'gender' => 'required|string'
        ]);

        $password = bcrypt($request->password);
        
        $query = Profile::find($id);
        $query->name = $request->username;
        $query->firstname = $request->firstname;
        $query->middlename  = $request->middlename;
        $query->lastname = $request->lastname;
        $query->gender = $request->gender;
        if(!empty($request->birthday)){
            $query->birthdate = $request->birthday;
        }
        if(!empty($request->password)){
            // if($bday != $today || $bday != $today2 || $bday != $today3){
                $query->password = $password;
            // }
        }
        $query->grade = $request->grade;
        $query->position = $request->position;
        $query->section = $request->section;
        $query->clubs = $request->clubs;
        $query->running = $request->candidate;
        $query->save();

        $voteQuery = new Vote;
        $voteQuery->student_id = $id;
        $voteQuery->year_of = date('Y-m-d');
        $voteQuery->running_for = $request->candidate;
        $voteQuery->votes = 0;
        $voteQuery->save();

        $checkbox = array(
            'approve' => ((is_null($request->approve)) ? "0" : "1"),
        );

        $queryVote = Vote::find($id);
        $queryVote->approved = $checkbox['approve'];
        $queryVote->save();

        return redirect('/home')->with('success', 'Editing Profile Success!');
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
