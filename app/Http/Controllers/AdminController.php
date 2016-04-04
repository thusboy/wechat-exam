<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Request;

use App\Exam;

use App\Question;

use App\Answer;

use App\Wechatuser;

use App\Score;

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
        $overview["people"] = Wechatuser::count();
        $overview["male"] = Wechatuser::where("sex","=","1")->count();
        $overview["female"] = Wechatuser::where("sex","=","2")->count();
        $overview["exam"] = Exam::count();
        $overview["question"] = Question::count();
        $overview["join"] = Score::count();
        return view("admin.overview",compact("overview"));
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

    public function storeExam(Requests\ExamFormRequest $request)
    {
        if ($request["eid"]) {
            $exam = Exam::find($request["eid"]);
            $exam->title =$request["title"];
            $exam->start = Date("Y-m-d",strtotime($request["start"]));
            $exam->end = Date("Y-m-d",strtotime($request["end"]));
            $exam->save();
        } else {
            Exam::create($request->all());
        }


        return redirect('admin/exam');
    }

    public function storeQuestion(Requests\QuestionFormRequest $request){
        $request = $request->all();

        $question = Question::create($request);
        $i=0;
        foreach($request["answer"] as $answer ){
            $answer["qid"] = $question->id;
            if(isset($answer["yn"])){
                $i++;
            }
            Answer::create($answer);
        }
        if($i>1){
            $question->choice=1;
            $question->save();
        }
        $exam = $question->exam;
        $exam->number_s= $exam->number_s+$question->score;
        $exam->number_q= $exam->number_q+1;
        $exam->save();
        return Redirect::action('AdminController@question', array('eid' => $request["eid"]));
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
                $question = Question::find($request["id"]);
                $exam = $question->exam;
                $exam->number_q = $exam->number_q-1;
                $exam->number_s = $exam->number_s-$question->score;
                $exam->save();
                $question->destroy($question->id);
                return Redirect::action('AdminController@question', array('eid' => $request["eid"]));
            break;

        }
    }

    public function rank(){
        $request = Request::all();
        $exams = Exam::get();
        if(isset($request["eid"])){

            $ranks = Score::rank($request["eid"])->get();
            $rank_active[$request["eid"]] = "active";

        }
        else{
            $wechatusers = Wechatuser::rank()->get();
            $rank_active[0] = "active";
        }
        return view("admin.rank",compact("wechatusers","exams","ranks","rank_active"));
    }


}
