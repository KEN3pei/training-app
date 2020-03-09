<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    //指定できてると思ったら$gurdedになっていたから$fillableが指定できた
    protected $gurded = array('id');
    
    protected $fillable = [
        'body',
        'user_id'
        ];
        
    public function belongto_user()
    {
        return $this->belongto('User::class');
    }
    // public static $rules = array(
    //     'user_id' => 'required',
    //     'body' => 'required',
    // );
}
