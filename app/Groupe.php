<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $fillable = [
        'myuser_id',
        'list_name'
        ];
        
    public static $rules = array(
        // 'myuser_id' => 'required',
        'list_name' => 'required',
    );
    
    public function membar_get()
    {
        return $this->hasMany('Groupemembar::class');
    }
}
