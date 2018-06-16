<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //   
    public $table = 'payments';     
    protected $fillable = ['user_id','card_number'];
}
