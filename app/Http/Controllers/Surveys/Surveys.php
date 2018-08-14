<?php

namespace App\Http\Controllers\Surveys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Survey\Survey;
use App\Model\User\Profile;
use App\Model\SurveyAnswer\Answer;
use App\Model\Club\Club;
use Illuminate\Support\Facades\Auth;

class Surveys extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = Profile::
                // ->where('clubs', '=', '1')
                select(
                    'users.*', 
                    'survey.id as sid', 
                    'survey.title as ct', 
                    'survey.title2 as ct2',  //ORM or eloquent || query to database
                    'survey.title3 as ct3',
                    'survey.created_at as screated',
                    'clubs.id as cid',
                    'clubs.clubs as cname'
                )
                ->leftJoin('survey', 'users.clubs', '=', 'survey.club_id')
                ->leftJoin('clubs', 'users.clubs', '=', 'clubs.id')
                ->get();

        // $query = "SELECT users.*, survey.id as sid"

        $queryAdmin = Club::select('*')->get();
        $allSurvery = Survey::select('*')
                    ->leftJoin('clubs', 'survey.club_id', '=', 'clubs.id')
                    ->get();

        
        // $isAnswered = Answer::where()

        // if(Auth::User()->position == '1'){
        //     return view('survey.surveyadmin', compact('queryAdmin'));
        // }else if(Auth::User()->position == '2'){
        //     return view('survey.surveyadmin', compact('queryAdmin'));
        // }else if(Auth::User()->position == '3'){
        //     if($query){
        //         return view('survey.survey', compact('query'));
        //     }else{
        //         return view('survey.survey')->with('error', 'Survey Not Found!');
        //     }
        // }else if(Auth::User()->position == '4'){
        //     return view('survey.surveyadmin', compact('queryAdmin'));
        // }else if(Auth::User()->position == '5'){
        //     return redirect('/home')->with('error', 'You don\'t have an access here');
        // }
        return view('survey.survey', compact('query', 'queryAdmin', 'allSurvery'));
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
            'survesurveyanswery1' => 'required|string|min:0',
            'surveyanswer2' => 'required|string|min:0',
            'surveyanswer3' => 'required|string|min:0',
        ]);

        $query = new Answer;
        $query->answer1 = $request->survesurveyanswery1;
        $query->answer2 = $request->surveyanswer2;
        $query->answer3 = $request->surveyanswer3;
        $query->student = $request->student_id;
        $query->save();

        return redirect('/survey')->with('success', 'Answering Survey Successful!');
    }

    public function addSurvey(Request $request){
        // return $request->all();
        $this->validate($request, [
            'survey1' => 'required|string|min:0',
            'survey2' => 'required|string|min:0',
            'survey3' => 'required|string|min:0',
        ]);

        $query = new Survey;
        $query->title = $request->survey1;
        $query->title2 = $request->survey2;
        $query->title3 = $request->survey3;
        $query->club_id = $request->group;
        $query->save();

        return redirect('/survey')->with('success', 'Adding Survey Success!');
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
        $query = Survey::where('id', '=', $id)->first();
        if($query){
            return view('survey.surveyedit', compact('query'));
        }else{
            return redirect('/survey')->with('error', 'Survey Not Found');
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
            'q1' => 'required|string',
            'q2' => 'required|string',
            'q3' => 'required|string',
        ]);

        $query = Answer::find($id);
        $query->student = $request->student_id;
        $query->answer1 = $request->q1;
        $query->answer2 = $request->q2;
        $query->answer3 = $request->q3;
        $query->save();
        return redirect('/survey')->with('success', 'Thanks for your participation!');
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
