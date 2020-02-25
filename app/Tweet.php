<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $gurded = array('id');
    
    protected $fillable = [
        'body',
        'user_id'
        ];
        
    // public static $rules = array(
    //     'user_id' => 'required',
    //     'body' => 'required',
    // );
}
