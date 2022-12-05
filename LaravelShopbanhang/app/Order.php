<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   public $timestamps = false; //set time ko cho no chay 
    protected $fillable = [
    	'customer_id','shipping_id','order_status','order_code'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';

}
