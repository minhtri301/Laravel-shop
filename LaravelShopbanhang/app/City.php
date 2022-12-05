<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
      public $timestamps = false; //set time ko cho no chay 
    protected $fillable = [
    	'name_city','type'
    ];
    protected $primaryKey = 'matp';
    protected $table = 'tbl_tinhthanhpho';
}
