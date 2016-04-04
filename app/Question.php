<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        "title",
        "score",
        "eid",
        "choice"
    ];



    public function answers()
    {
        return $this->hasMany('App\Answer','qid');
    }

    public function exam()
    {
        return $this->belongsTo('App\Exam','eid');
    }
}
