<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body'];


    public function answer()
    {

        return $this->belongsTo('App\Answer');
    }

    public function user()
    {

        return $this->belongsTo('App\User');
    }

    //public function question(){

    //return $this->belongsTo('App\Question');
    //}
}
