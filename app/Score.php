<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //
    protected $fillable = [
        "openid",
        "eid",
        "score",
        "score_r",
        "second"
    ];

    public function scopeTop10($query){
        return $query->orderBy("score","desc")->orderBy("second")->orderBy("created_at","desc")->limit(10);
    }

    public function scopeRank($query,$eid){
        return $query->where("eid","=",$eid)->orderBy("score","desc")->orderBy("second")->orderBy("created_at","desc");
    }

    public function wechatuser()
    {
        return $this->belongsTo('App\Wechatuser',"openid","openid");

    }

    public function exam()
    {
        return $this->belongsTo('App\Exam',"eid");
    }
}
