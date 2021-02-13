<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
            'amount' => 'required',
            'transaction_id' => 'required',
            'memo' => 'required',
            'date' => 'required',
        );
}
