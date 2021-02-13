<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
            'amount' => 'required',
            'transaction_type' => 'required',
            'memo' => 'required',
            'created_at' => 'required',
        );
}
