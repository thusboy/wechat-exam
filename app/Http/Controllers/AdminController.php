<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Request;

use App\Exam;

use App\Question;

use App\Answer;

use Redirect;

class AdminController extends Controller
{

    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {

        return view('admin.sum');
    }

    public function exam()
    {
        $exams = Exam::all();
        return view('admin.exam',compact('exams'));
    }

    public function question()
    {
        $request =Request::all();
        $questions = Question::where('eid','=',$request["eid"])->get();
        $questions->eid = $request["eid"];
        foreach($questions as $question){
            $answers = Answer::where('qid','=',$question->id)->get();
            $question->answer= $answers;
            $temp[] = $question;
        }
        //$questions = $temp;
        return view('admin.question',compact('questions'));
    }

    public function store()
    {
        $request = Request::all();
        switch ($request["type"]) {
            case "exam":
                if ($request["eid"]) {
                    $exam = Exam::find($request["eid"]);
                    $exam->title = $request["title"];
                    $exam->start = $request["start"];
                    $exam->end = $request["end"];
                    $exam->save();
                } else {
                    Exam::create($request);
                }

                return redirect('admin/exam');
            break;
            case "question":
                $question = Question::create($request);
                foreach($request["answer"] as $answer ){
                    $answer["qid"] = $question->id;
                    Answer::create($answer);
                }
                return Redirect::action('AdminController@question', array('eid' => $request["eid"]));
            break;

        }

    }


    public function delete()
    {
        $request = Request::all();
        switch($request["term"]){
            case "exam":
                Exam::destroy($request["id"]);
                return redirect("admin/exam");
            break;
            case "question":
                Question::destroy($request["id"]);
                return Redirect::action('AdminController@question', array('eid' => $request["eid"]));
            break;

        }
    }

}
