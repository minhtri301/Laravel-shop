<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false; //set time ko cho no chay 
    protected $fillable = [
    	'brand_name','meta_keywords_brand','slug_brand_product','brand_desc','brand_status'
    ];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';


}
