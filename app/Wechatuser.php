<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wechatuser extends Model
{
    //
    protected $primaryKey = 'openid';
    protected $fillable = [
        "openid",
        "nickname",
        "headimgurl",
        "sex",
        "mobile",
        "province",
        "country",
        "city",
        "subscribe_time",
        "score",
        "second"
    ];

    public function scopeTop($query,$number){
        return $query->where("mobile",">","0")->orderBy("score",'desc')->orderBy("second")->orderBy("created_at",'desc')->limit($number);
    }

    public function scopeRank($query){
        return $query->where("mobile",">","0")->orderBy("score",'desc')->orderBy("second")->orderBy("created_at",'desc');
    }

    public function scores()
    {
         return $this->hasMany('App\Score');
    }
}
