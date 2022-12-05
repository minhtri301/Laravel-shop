<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false; //set time ko cho no chay 
    protected $fillable = [
    	'name_quanhuyen','type','matp',
    ];
    protected $primaryKey = 'maqh';
    protected $table = 'tbl_quanhuyen';
}
