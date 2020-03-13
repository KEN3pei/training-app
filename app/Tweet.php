<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Tweet extends Model
{
    //指定できてると思ったら$gurdedになっていたから$fillableが指定できた
    protected $gurded = array('id');
    
    protected $fillable = [
        'body',
        'user_id'
        ];
        
    public function belongsto_user()
    {
        return $this->belongsTo('App\User');
    }
    // public static $rules = array(
    //     'user_id' => 'required',
    //     'body' => 'required',
    // );
}
