<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupemembar extends Model
{
    protected $fillable = [
        'list_id',
        'list_membar'
        ];
        
    public static $rules = array(
        'list_id' => 'required',
    );
    
    public function belongto()
    {
        return $this->belongsTo('App\Groupe');
    }
}
