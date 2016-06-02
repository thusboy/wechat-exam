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
        $this->js = EasyWeChat::js();

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $js = $this->js;
        $wechatuser =Wechatuser::where('openid','=',$this->wechatuser->id)->first();
        if(!$wechatuser) {
            $wechatuser = Wechatuser::Create(EasyWeChat::user()->get($this->wechatuser->id)->toArray());
        }
        $exam = Exam::active()->first();
        if($exam) {
            $finished = Score::where('openid','=', $this->wechatuser->id)->where('eid','=',$exam->id)->first();
            if(!$finished) {
                $page_title =$exam->title;
                //随机抽取7道单选,3道多选
                $questions1= $exam->questions()->where("choice",0)->limit($exam->number_s_s)->orderby(DB::raw("rand()"))->get();
                $questions2= $exam->questions()->where("choice",1)->limit($exam->number_s_m)->orderby(DB::raw("rand()"))->get();
                $questions = $questions1->merge($questions2);
                $status = "ok";

            }
            else{
                $status = "finished";
            }
        }
        else{
            $status = "noexam";
        }
        return view('home', compact("exam","page_title","js","questions","status"));
    }
    public function finished(){
        $js = $this->js;
        $request = Request::all();
        $exam = Exam::active()->first();
        if($request) {
            $questions = Question::where('eid', '=', $request["eid"])->get();
            $score = 0;
            $score_f =0;
            foreach ($questions as $question) {
                $correct = 1;
                $score_f = $score_f + $question->score;
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
            $score_array["score"] = (int)(($score / $score_f) * 100);
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
            $wechatuser->score = $wechatuser->score+$score_array["score"];
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
        return view("finished",compact("score","wechatuser","page_title","re_submit",'score_class','scores','js'));
    }
    public function addmobile(Requests\MobileFormReuquest $request){
        $request = $request->all();
        $wechatuser = Wechatuser::where('openid','=',$this->wechatuser->id)->first();
        $wechatuser->mobile=$request["mobile"];
        $wechatuser->save();
        return redirect("home/finished");

    }
    public function rank(){
        $js = $this->js;
        $wechatusers = Wechatuser::top(10)->get();
        return view("rank",compact("wechatusers","js"));
    }

    public function subscribe(){
        $qrcode = EasyWeChat::qrcode();
        $result = $qrcode->forever("foo");// 或者 $qrcode->forever("foo");
        $ticket = $result->ticket;
        $url = $qrcode->url($ticket);
        return view("qrcode",compact("url"));
    }
}
