<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
       public $timestamps = false; //set time ko cho no chay 
    protected $fillable = [
    	'coupon_name','coupon_code','coupon_time','coupon_number','coupon_condition'
    ];
    protected $primaryKey = 'coupon_id';
    protected $table = 'tbl_coupon';

}
