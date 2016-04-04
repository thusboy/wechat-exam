<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable = [
        "title",
        "yn",
        "qid"
    ];

    public function question()
    {
        return $this->belongsTo('App\Question','qid');
    }
}
