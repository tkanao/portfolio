<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'user_id' => 'required',
        // 'balance' => 'required'
        );
        
        
        
    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
}
