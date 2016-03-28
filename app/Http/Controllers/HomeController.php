<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Request;

use App\Exam;

use App\Question;

use App\Answer;

use Redirect;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $now = Date("Y-m-d",time());
        $exam = Exam::where('start','<',$now)->where('end','>',$now)->orderBy("updated_at",'desc')->first();
        if($exam) {
            $questions = Question::where('eid', '=', $exam->id)->orderBy(DB::raw('RAND()'))->get();
            foreach ($questions as $question) {
                $answers = Answer::where('qid', '=', $question->id)->orderBy(DB::raw('RAND()'))->get();
                $question->answers = $answers;
                $temp[] = $question;
            }
            $questions = $temp;
            return view('home',compact("questions"));
        }
        else{
            return redirect("/");
        }

    }
}
