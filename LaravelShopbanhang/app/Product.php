<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time ko cho no chay 
    protected $fillable = [
    	'product_name','category_id','slug_product','brand_id','product_desc','product_content','product_price','product_image','product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

 
}
