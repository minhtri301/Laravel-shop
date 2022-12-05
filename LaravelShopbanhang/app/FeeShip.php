<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeShip extends Model
{
     public $timestamps = false; //set time ko cho no chay 
    protected $fillable = [
    	'fee_matp','fee_maqh','fee_xaid','fee_feeship'
    ];
    protected $primaryKey = 'fee_id';
    protected $table = 'tbl_feeship';

    public function city(){
    	return $this->belongsTo('App\City','fee_matp');
    }
    public function province(){
    	return $this->belongsTo('App\Province','fee_maqh');
    }
    public function wards(){
    	return $this->belongsTo('App\Wards','fee_xaid');
    }
}
