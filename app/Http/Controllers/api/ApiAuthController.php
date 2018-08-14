<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Model\Survey\Survey;
use App\Model\SurveyAnswer\Answer;
use App\Model\Event\Event as Event;
use App\Model\Vote\Vote as Vote;

class ApiAuthController extends Controller
{
    //
	public function getSurvey(Request $request){
		$query = Survey::where('id', '=', $request->id)->first();
		return Response::json(['query'=>$query]);
	}

    public function postsurvey(Request $request){
    	$test = array(
    		'q1' => $request->q1,
    		'q2' => $request->q1,
    		'q3' => $request->q3,
    		'group' => $request->group
    	);

    	$query = new Survey;
    	$query->title = $request->q1;
    	$query->title2 = $request->q1;
    	$query->title3 = $request->q3;
    	$query->club_id = $request->group;
    	// $query->created_at = date('Y-m-d H:i:s');
    	// $query->updated_at = date('Y-m-d H:i:s');
    	$query->save();

    	return Response::json(['query'=>$test, 'status'=>$query]);
    }

    public function getSurveyAnswer(Request $request){
    	$query = new Answer;
    	$query->student = $request->id;
    	$query->answer1 = $request->a1;
    	$query->answer2 = $request->a2;
    	$query->answer3 = $request->a3;
    	$query->save();

    	return Response::json(['query'=>$query]);
    }

    public function geteventreports(Request $request){
        $query = Event::where('whenevent', '=', $request->from)
                        ->where('events_who', '=', $request->grade)->get();

        return Response::json(['query'=>$query]);
    }

    public function getsurveyreport(Request $request){
        $query = Survey::where('club_id', '=', $request->club)
                    ->where('created_at', '=', $request->from)
                    ->get();
        return Response::json(['query'=>$query]);
    }

    public function getvotingreports(Request $request){
        $query = Vote::where('approved', '=', 1)
                    ->leftJoin('users', 'vote.student_id', '=', 'users.id')
                    ->leftJoin('cand_position', 'vote.running_for', '=', 'cand_position.id')
                    ->where('running_for', '=', $request->position)
                    ->get();
        return Response::json(['query'=>$query]);
    }
}
