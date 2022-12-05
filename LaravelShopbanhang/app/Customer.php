<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
       public $timestamps = false; //set time ko cho no chay 
    protected $fillable = [
    	'customer_name','customer_email','customer_password','customer_phone'
    ];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customers';
}
