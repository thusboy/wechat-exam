<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Exam extends Model
{
    //protected $table = 'exam';

    protected $fillable = [
        "title",
        "start",
        "end",
        "active",
        "number_s_s",
        "number_s_m",
        "number_q_s",
        "number_q_m",
        "number_u"
    ];

    public function scopeActive($query){
        $now = Date("Y-m-d",time());
        return $query->where('start','<=',$now)->where('end','>=',$now)->orderBy("updated_at",'desc');
    }

    public function questions()
    {

        return $this->hasMany('App\Question','eid');
    }


    public function scores()
    {
        return $this->hasMany('App\Score','eid');
    }
}
