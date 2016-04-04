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
        "number_s",
        "number_q",
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
