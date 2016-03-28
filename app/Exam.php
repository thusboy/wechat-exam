<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Exam extends Model
{
    //protected $table = 'exam';

    protected $fillable = [
        "title",
        "start",
        "end"
    ];

}
