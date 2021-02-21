<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
            'amount' => 'required',
            'transaction_type' => 'required',
            'memo' => 'required',
            'date' => 'required',
            // 'account_id' => 'required',
            // 'balance' => 'required'
        );
}
