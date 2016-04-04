<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use Request;

use App\Exam;

use App\Question;

use App\Answer;

use App\Score;

use App\Wechatuser;

use Redirect;

use DB;

use EasyWeChat;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->wechatuser = session('wechat.oauth_user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome(){
        $request = Request::all();
        return view('welcome',compact("request"));
    }
    public function index()
    {
        $wechatuser =Wechatuser::where('openid','=',$this->wechatuser->id)->first();
        if(!$wechatuser) {
            $wechatuser = Wechatuser::Create(EasyWeChat::user()->get($this->wechatuser->id)->toArray());
        }
        $exam = Exam::active()->first();
        if($exam) {
            $finished = Score::where('openid','=', $this->wechatuser->id)->where('eid','=',$exam->id)->first();
            if(!$finished) {
                $page_title =$exam->title;
                return view('home', compact("exam","page_title"));
            }
            else{
                return Redirect::action('HomeController@welcome',array('status' => 'finished'));
            }
        }
        else{
            return Redirect::action('HomeController@welcome',array('status' => 'noexam'));
        }

    }
    public function finished(){

        $request = Request::all();
        $exam = Exam::active()->first();
        if($request) {
            $questions = Question::where('eid', '=', $request["eid"])->get();
            $score = 0;
            foreach ($questions as $question) {
                $correct = 1;
                foreach ($question->answers as $answer) {
                    if (isset($request["answers"][$question->id][$answer->id])) {
                        $answerd = 1;
                    } else {
                        $answerd = 0;
                    }
                    if (!($answerd == $answer->yn)) {
                        $correct = 0;
                       // echo "request[".$question->id."][".$answer->title."]:".isset($request["answers"][$question->id][$answer->id])."=".$answer->yn.":".$correct."<br/>";
                    }
                }
                if ($correct) {
                    $score = $score + $question->score;
                }

            }
            $score_array["eid"] = $request["eid"];
            $score_array["second"] = $request["second"];
            $score_array["openid"] = $this->wechatuser->id;
            $score_array["score"] = (int)(($score / $exam->number_s) * 100);
            $score_array["score_r"] = $score;
        }
        $score = Score::where('openid', '=', $this->wechatuser->id)->where('eid', '=', $exam->id)->first();
        $re_submit = false;
        if($request && $score){
            $re_submit = true;
        }
        if (!$score) {
            $score = Score::create($score_array);
            //更新关联数据
            $exam->number_u = $exam->number_u+1;
            $exam->save();
            $wechatuser = $score->wechatuser;
            $wechatuser->score = $wechatuser->score+$score_array["score_r"];
            $wechatuser->second = $wechatuser->second+$request["second"];
            $wechatuser->save();
        }
        else{
            $wechatuser = $score->wechatuser;
        }
        if($score->score>80){
            $score_class = "high_score";
            $page_title = "恭喜您高分完成";
        }
        elseif($score->score>60 && $score->score<80){
            $score_class = "middle_score";
            $page_title = "还不错哦!";
        }
        else{
            $score_class = "low_score";
            $page_title = "再接再厉";
        }
        $scores = $exam->scores()->top10()->get();
        return view("finished",compact("score","wechatuser","page_title","re_submit",'score_class','scores'));
    }
    public function addmobile(Requests\MobileFormReuquest $request){
        $request = $request->all();
        $wechatuser = Wechatuser::where('openid','=',$this->wechatuser->id)->first();
        $wechatuser->mobile=$request["mobile"];
        $wechatuser->save();
        return redirect("home/finished");

    }
    public function rank(){
        $wechatusers = Wechatuser::top(10)->get();
        return view("rank",compact("wechatusers"));
    }

    public function subscribe(){
        $qrcode = EasyWeChat::qrcode();
        $result = $qrcode->forever("foo");// 或者 $qrcode->forever("foo");
        $ticket = $result->ticket;
        $url = $qrcode->url($ticket);
        return view("qrcode",compact("url"));
    }
}
